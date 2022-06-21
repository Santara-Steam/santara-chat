<?php

namespace App\Http\Controllers;

use App\Helper\Auth;
use App\Models\Group;
use App\Models\GroupUser;
use App\Models\Setting;
use App\Models\User;
use App\Repositories\BlockUserRepository;
use App\Repositories\UserRepository;
use GuzzleHttp\Client;
use Illuminate\Contracts\View\Factory;
use Illuminate\Http\Request;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Http;
use Illuminate\View\View;

/**
 * Class ChatController
 */
class ChatController extends AppBaseController
{
    /**
     * Show the application dashboard.
     *
     * @param Request $request
     *
     * @return Factory|View
     */
    public function index(Request $request)
    {
        $conversationId = $request->get('conversationId');
        $data['conversationId'] = ! empty($conversationId) ? $conversationId : 0;

        /** @var UserRepository $userRepository */
        $userRepository = app(UserRepository::class);
        /** @var BlockUserRepository $blockUserRepository */
        $myContactIds = $userRepository->myContactIds();

        /** @var BlockUserRepository $blockUserRepository */
        $blockUserRepository = app(BlockUserRepository::class);
        list($blockUserIds, $blockedByMeUserIds) = $blockUserRepository->blockedUserIds();

        $data['users'] = User::toBase()
            ->limit(50)
            ->orderBy('name')
            ->select(['name', 'id'])
            ->pluck('name', 'id')
            ->except(getLoggedInUserId());
        $data['enableGroupSetting'] = isGroupChatEnabled();
        $data['membersCanAddGroup'] = canMemberAddGroup();
        $data['myContactIds'] = $myContactIds;
        $data['blockUserIds'] = $blockUserIds;
        $data['blockedByMeUserIds'] = $blockedByMeUserIds;

        /** @var Setting $setting */
        $setting = Setting::where('key', 'notification_sound')->pluck('value', 'key')->toArray();
        if (isset($setting['notification_sound'])) {
            $data['notification_sound'] = app(Setting::class)->getNotificationSound($setting['notification_sound']);
        }

//        $baseUrl = env('SANTARA_API_BASE_URL');
//        $response = Http::get($baseUrl . "/ownPortofolio", 'userId=' . Auth::ID())->body();
//        $response = json_decode($response, true);

        $response = $this->getApiPortofolio();

        if (isset($response['emitenIds'])) {
            foreach ($response['emitenIds'] as $emitenId) {
                $groupChat = Group::where('emiten_id', '=', $emitenId)->first();

                /**
                 * @var Group $groupChat
                 */
                if ($groupChat) {
                    $gc = $groupChat->users->map(function ($value) {
                        return $value->id;
                    });

                    if (!in_array(Auth::ID(), $gc->toArray())) {
                        $groupChat->users()->attach(Auth::ID(), ['added_by' => 1]);
                    }
                }
            }

            $groupUsers = GroupUser::whereUserId(Auth::ID())->get()
                ->map(function ($value){
                    return $value->group->emiten_id;
                })->toArray();

            $diffGroup = array_diff($groupUsers, $response['emitenIds']);

            foreach ($diffGroup as $groupID) {
                $userGroup = GroupUser::whereHas('group', function ($query) use ($groupID){
                    return $query->where('emiten_id', $groupID);
                })->where('user_id', Auth::ID())->first();

                if ($userGroup) {
                    $userGroup->delete();
                }
            }
        }

        if (!empty($response['data'])) {
            $data["portofolio"] = ['data'];
        }

        return view('chat.index')->with($data);
    }

    /**
     * @throws \Psr\Container\ContainerExceptionInterface
     * @throws \GuzzleHttp\Exception\GuzzleException
     * @throws \Psr\Container\NotFoundExceptionInterface
     */
    public function getApiPortofolio(): ?array
    {
        $client = new Client();

        $session = session()->get('session');

        if ($session) {
            $headers = [
                'Authorization' => 'Bearer ' .$session['token'],
                'Content-Type' => 'application/json',
                'Accept' => 'application/json'
            ];
        }

        $responseToken = $client->request('GET', 'https://tulabi.com:3801' . '/v3.7.1/portofolio/?category=' , [
            'headers' => $headers,
        ]);

        if ($responseToken->getStatusCode() == 200) {
            $tokens = json_decode($responseToken->getBody()->getContents(), TRUE);
            $mapped = array_map(function ($value) {
                return $value['id'];
            }, $tokens['data']);

            return ["emitenIds" => $mapped];
        }

        return null;
    }
}
