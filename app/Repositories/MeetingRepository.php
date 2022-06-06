<?php

namespace App\Repositories;

use App\Http\Requests\API\CreateMeetingRequest;
use App\Models\ZoomMeeting;
use App\Traits\ZoomMeetingTrait;
use Auth;
use Carbon\Carbon;
use Exception;
use Illuminate\Database\Eloquent\Collection;
use Symfony\Component\HttpKernel\Exception\UnprocessableEntityHttpException;

/**
 * Class MeetingRepository
 */
class MeetingRepository extends BaseRepository
{
    use ZoomMeetingTrait;

    const MEETING_TYPE_INSTANT = 1;
    const MEETING_TYPE_SCHEDULE = 2;
    const MEETING_TYPE_RECURRING = 3;
    const MEETING_TYPE_FIXED_RECURRING_FIXED = 8;

    /**
     * @var array
     */
    protected $fieldSearchable = [
        'title',
    ];

    /**
     * Return searchable fields.
     *
     * @return array
     */
    public function getFieldsSearchable()
    {
        return $this->fieldSearchable;
    }

    /**
     * Configure the Model.
     **/
    public function model()
    {
        return ZoomMeeting::class;
    }

    /**
     * @param array $data
     *
     *
     * @return bool
     */
    public function store($data)
    {
        try {
            $startTime = $data['start_time'];
            $data['time_zone'] = getTimeZone()[$data['time_zone']];
            $zoom = $this->create($data);
            $data['password'] = $zoom['data']['password'];
            $data['meeting_id'] = $zoom['data']['id'];
            $data['meta'] = $zoom['data'];
            $data['created_by'] = Auth::id();
            $data['start_time'] = Carbon::parse($startTime)->format('Y-m-d H:i:s');

            $zoomModel = ZoomMeeting::create($data);

            $zoomModel->members()->sync($data['members']);

            return true;
        } catch (Exception $exception) {
            new UnprocessableEntityHttpException($exception->getMessage());
        }
    }

    /**
     * @return ZoomMeeting[]|Collection
     */
    public function getZoomMeetings()
    {
        return ZoomMeeting::all();
    }

    /**
     * @param int $id
     * @param array $data
     *
     * @return bool
     */
    public function updateZoomMeeting($id, $data)
    {
        try {
            $zoomMeeting = ZoomMeeting::findOrFail($id);

            $startTime = $data['start_time'];
            $data['time_zone'] = getTimeZone()[$data['time_zone']];
            $this->update($zoomMeeting->meeting_id, $data);
            $zoom = $this->get($zoomMeeting->meeting_id);
            $data['password'] = $zoom['data']['password'];
            $data['meta'] = $zoom['data'];
            $data['created_by'] = Auth::id();
            $data['start_time'] = Carbon::parse($startTime)->format('Y-m-d H:i:s');

            $zoomModel = $zoomMeeting->update($data);

            $zoomMeeting->members()->sync($data['members']);

            return true;
        } catch (Exception $exception) {
            new UnprocessableEntityHttpException($exception->getMessage());
        }
    }

    /**
     * @param int $id
     *
     * @return bool
     */
    public function deleteMeeting($id)
    {
        try {
            $zoomMeeting = ZoomMeeting::findOrFail($id);
            $this->delete($zoomMeeting->meeting_id);
            $zoomMeeting->members()->detach();
            $zoomMeeting->delete();

            return true;
        } catch (Exception $exception) {
            new UnprocessableEntityHttpException($exception->getMessage());
        }
    }

    /**
     * @param int $id
     * @return bool
     */
    public function changeMeetingStatus($id, $status)
    {
        $meeting = ZoomMeeting::findOrFail($id);
        $meeting->update(['status' => $status]);

        return true;
    }
}
