<?php

use App\Http\Controllers\API;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\BroadcastController;
use App\Http\Controllers\ChatController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\MeetingController;
use App\Http\Controllers\ReportUserController;
use App\Http\Controllers\RoleController;
use App\Http\Controllers\SettingsController;
use App\Http\Controllers\SsoController;
use App\Http\Controllers\UserController;
use App\Models\User;
use Database\Seeders\CreatePermissionSeeder;
use Database\Seeders\SetIsDefaultSuperAdminSeeder;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\URL;
use Illuminate\Support\Str;
use Rap2hpoutre\LaravelLogViewer\LogViewerController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

if (!App::environment('local')) {
    URL::forceScheme('https');
}

Route::group(["middleware" => ['web']], function ($router) {
    $router->match(
        ['get', 'post'], '/broadcasting/auth',
        '\\'.BroadcastController::class.'@authenticate'
    )->withoutMiddleware([\Illuminate\Foundation\Http\Middleware\VerifyCsrfToken::class]);
});


Route::get('/', function () {
    if (\App\Helper\Auth::User()) {
        return redirect('/conversations');
    }
    return view('home.index');
})->name('home');

Route::get('/authorize', [SsoController::class, 'authorizes']);
Route::get('/grant-access', function (){
    return redirect()->away(env('SANTARA_BASE_URL') . '/user/grant-access');
});

//Auth::routes();
Route::get('activate', [AuthController::class, 'verifyAccount']);

//Route::get('/home', [HomeController::class, 'index']);
Route::post('update-language', [UserController::class, 'updateLanguage'])->middleware('auth')->name('update-language');

// Impersonate Logout
Route::get('/users/impersonate-logout',
    [UserController::class, 'userImpersonateLogout'])->name('impersonate.userLogout');

Route::group(['middleware' => 'authorized'], function () {
    //view routes
    Route::get('/conversations',
        [ChatController::class, 'index'])->name('conversations');

    Route::get('profile', [UserController::class, 'getProfile']);
    Route::post('logout', [\App\Http\Controllers\Auth\LoginController::class, 'logout']);

    //get all user list for chat
    Route::get('users-list', [API\UserAPIController::class, 'getUsersList']);
    Route::get('get-users', [API\UserAPIController::class, 'getUsers'])->name('get-users')->name('get-users');
    Route::delete('remove-profile-image', [API\UserAPIController::class, 'removeProfileImage'])->name('remove-profile-image');
    /** Change password */
    Route::post('change-password', [API\UserAPIController::class, 'changePassword'])->name('change-password');
    Route::get('conversations/{ownerId}/archive-chat', [API\UserAPIController::class, 'archiveChat'])->name('conversations.archive-chat');

    Route::get('get-profile', [API\UserAPIController::class, 'getProfile']);
    Route::post('profile', [API\UserAPIController::class, 'updateProfile'])->name('update.profile');
    Route::post('update-last-seen', [API\UserAPIController::class, 'updateLastSeen'])->name('update-last-seen');

    Route::post('send-message',
        [API\ChatAPIController::class, 'sendMessage'])->name('conversations.store')->middleware('sendMessage');
    Route::get('users/{id}/conversation', [API\UserAPIController::class, 'getConversation'])->name('users.conversation');
    Route::get('conversations-list', [API\ChatAPIController::class, 'getLatestConversations'])->name('conversations-list');
    Route::get('archive-conversations', [API\ChatAPIController::class, 'getArchiveConversations'])->name('archive-conversations');
    Route::post('read-message', [API\ChatAPIController::class, 'updateConversationStatus'])->name('read-message');
    Route::post('file-upload', [API\ChatAPIController::class, 'addAttachment'])->name('file-upload');
    Route::post('image-upload', [API\ChatAPIController::class, 'imageUpload'])->name('image-upload');
    Route::get('conversations/{userId}/delete', [API\ChatAPIController::class, 'deleteConversation'])->name('conversations.destroy');
    Route::post('conversations/message/{conversation}/delete', [API\ChatAPIController::class, 'deleteMessage'])->name('conversations.message-conversation.delete');
    Route::post('conversations/{conversation}/delete', [API\ChatAPIController::class, 'deleteMessageForEveryone']);
    Route::get('/conversations/{conversation}', [API\ChatAPIController::class, 'show']);
    Route::post('send-chat-request', [API\ChatAPIController::class, 'sendChatRequest'])->name('send-chat-request');
    Route::post('accept-chat-request',
        [API\ChatAPIController::class, 'acceptChatRequest'])->name('accept-chat-request');
    Route::post('decline-chat-request',
        [API\ChatAPIController::class, 'declineChatRequest'])->name('decline-chat-request');

    /** Web Notifications */
    Route::put('update-web-notifications', [API\UserAPIController::class, 'updateNotification'])->name('update-web-notifications');

    /** BLock-Unblock User */
    Route::put('users/{user}/block-unblock', [API\BlockUserAPIController::class, 'blockUnblockUser'])->name('users.block-unblock');
    Route::get('blocked-users', [API\BlockUserAPIController::class, 'blockedUsers']);

    /** My Contacts */
    Route::get('my-contacts', [API\UserAPIController::class, 'myContacts'])->name('my-contacts');

    /** Groups API */
    Route::post('groups', [API\GroupAPIController::class, 'create'])->name('groups.create');
    Route::post('groups/{group}', [API\GroupAPIController::class, 'update'])->name('groups.update');
    Route::get('groups', [API\GroupAPIController::class, 'index'])->name('groups.index');
    Route::get('groups/{group}', [API\GroupAPIController::class, 'show'])->name('group.show');
    Route::put('groups/{group}/add-members', [API\GroupAPIController::class, 'addMembers'])->name('groups-group.add-members');
    Route::delete('groups/{group}/members/{user}', [API\GroupAPIController::class, 'removeMemberFromGroup'])->name('group-from-member-remove');
    Route::delete('groups/{group}/leave', [API\GroupAPIController::class, 'leaveGroup'])->name('groups.leave');
    Route::delete('groups/{group}/remove', [API\GroupAPIController::class, 'removeGroup'])->name('group-remove');
    Route::put('groups/{group}/members/{user}/make-admin', [API\GroupAPIController::class, 'makeAdmin'])->name('groups.members.make-admin');
    Route::put('groups/{group}/members/{user}/dismiss-as-admin', [API\GroupAPIController::class, 'dismissAsAdmin'])->name('groups.members.dismiss-as-admin');
    Route::get('users-blocked-by-me', [API\BlockUserAPIController::class, 'blockUsersByMe']);

    Route::get('notification/{notification}/read', [API\NotificationController::class, 'readNotification'])->name('notification.read-notification');
    Route::get('notification/read-all', [API\NotificationController::class, 'readAllNotification'])->name('read-all-notification');

    /** Web Notifications */
    Route::put('update-web-notifications', [API\UserAPIController::class, 'updateNotification']);
    Route::put('update-player-id', [API\UserAPIController::class, 'updatePlayerId'])->name('update-player-id');
    //set user custom status route
    Route::post('set-user-status', [API\UserAPIController::class, 'setUserCustomStatus'])->name('set-user-status');
    Route::get('clear-user-status', [API\UserAPIController::class, 'clearUserCustomStatus'])->name('clear-user-status');

    //report user
    Route::post('report-user', [API\ReportUserController::class, 'store'])->name('report-user.store');

    // Laravel Logs route
    Route::get('logs', [LogViewerController::class, 'index']);
});

// users
Route::group(['middleware' => ['permission:manage_users', 'auth', 'user.activated']], function () {
    Route::resource('users', UserController::class);
    Route::post('users/{user}/active-de-active', [UserController::class, 'activeDeActiveUser'])
        ->name('active-de-active-user');
    Route::post('users/{user}/update', [UserController::class, 'update'])->name('user.update');
    Route::delete('users/{user}/archive', [UserController::class, 'archiveUser'])->name('archive-user');
    Route::post('users/restore', [UserController::class, 'restoreUser'])->name('user.restore-user');
    Route::get('users/{user}/login', [UserController::class, 'userImpersonateLogin'])->name('user-impersonate-login');
    Route::post('users/{user}/email-verified', [UserController::class, 'isEmailVerified'])->name('user.email-verified');
});

// roles
Route::group(['middleware' => ['permission:manage_roles', 'auth', 'user.activated']], function () {
    Route::resource('roles', RoleController::class)->except('update');
    Route::post('roles/{role}/update', [RoleController::class, 'update'])->name('roles.update');
});

// settings
Route::group(['middleware' => ['permission:manage_settings', 'auth', 'user.activated']], function () {
    Route::get('settings', [SettingsController::class, 'index'])->name('settings.index');
    Route::post('settings', [SettingsController::class, 'update'])->name('settings.update');
});

// reported-users
Route::group(['middleware' => ['permission:manage_reported_users', 'auth', 'user.activated']], function () {
    Route::resource('reported-users', ReportUserController::class);
});

// meetings
Route::group(['middleware' => ['permission:manage_meetings', 'auth', 'user.activated']], function () {
    Route::resource('meetings', MeetingController::class);
    Route::get('meetings/{meeting}/change-status/{status}', [MeetingController::class, 'changeMeetingStatus'])->name('meeting.change-meeting-status');
    Route::get('member/meetings', [MeetingController::class, 'showMemberMeetings'])->name('meetings.member_index');
});

Route::group(['middleware' => ['web']], function () {
    Route::get('login/{provider}', [\App\Http\Controllers\Auth\SocialAuthController::class, 'redirect']);
    Route::get('login/{provider}/callback', [\App\Http\Controllers\Auth\SocialAuthController::class, 'callback']);
});

//Route::get('/login', function (\Illuminate\Http\Request $request){
//    $request->session()->put("state", $state = \Illuminate\Support\Str::random(40));
//    $query = http_build_query([
//        "client_id" => "9680211d-267e-41a1-ad8b-bc6d5cba5504",
//        "redirect_uri" => "http://127.0.0.1:8888/callback",
//        "response_type" => "code",
//        "scope" => "",
//        "state" => $state
//    ]);
//
//    return redirect("http://127.0.0.1:8000/oauth/authorize?" . $query);
//});

Route::get("/callback", function (\Illuminate\Http\Request $request) {
    $state = $request->session()->pull("state");

    throw_unless(strlen($state) > 0 && $state == $request->state,
        \http\Exception\InvalidArgumentException::class);
    $response = \Illuminate\Support\Facades\Http::post('http://127.0.0.1:8000/oauth/token',
        [
            "grant_type" => "authorization_code",
            "client_id" => "9680211d-267e-41a1-ad8b-bc6d5cba5504",
            "client_secret" => "zPRs4EeKZNJ5WtK9Gch4e5VUywjhMy64fbSD0EVy",
            "redirect_uri" => "http://127.0.0.1:8888/callback",
            "code" => $request->code
        ]
    )->json();
    $request->session()->put($response);
//    return response()->json(["response" => $response]);
    return redirect('/authuser');
});

Route::get("/authuser", function (\Illuminate\Http\Request $request){
    $access_token = $request->session()->get("access_token");
    $response = \Illuminate\Support\Facades\Http::withHeaders([
        "Accept" => "application/json",
        "Authorization" => "Bearer " . $access_token,
    ])->get("http://127.0.0.1:8000/api/user");

    return $response->json();
});
