<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * Class ZoomMeeting
 *
 * @property int $id
 * @property string $topic
 * @property string $start_time
 * @property string $duration
 * @property int $host_video
 * @property int $participant_video
 * @property string $agenda
 * @property int $created_by
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\User[] $members
 * @property-read int|null $members_count
 * @method static \Illuminate\Database\Eloquent\Builder|ZoomMeeting newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|ZoomMeeting newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|ZoomMeeting query()
 * @method static \Illuminate\Database\Eloquent\Builder|ZoomMeeting whereAgenda($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ZoomMeeting whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ZoomMeeting whereCreatedBy($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ZoomMeeting whereDuration($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ZoomMeeting whereHostVideo($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ZoomMeeting whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ZoomMeeting whereParticipantVideo($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ZoomMeeting whereStartTime($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ZoomMeeting whereTopic($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ZoomMeeting whereUpdatedAt($value)
 * @mixin \Eloquent
 */
class ZoomMeeting extends Model
{
    protected $table = 'zoom_meetings';

    const STATUS_AWAITED = 1;
    const STATUS_FINISHED = 2;

    const status = [
        self::STATUS_AWAITED => 'Awaited',
        self::STATUS_FINISHED => 'Finished',
    ];

    protected $appends = ['status_text'];

    protected $fillable = [
        'topic',
        'start_time',
        'duration',
        'host_video',
        'participant_video',
        'agenda',
        'created_by',
        'status',
        'meta',
        'meeting_id',
        'time_zone',
        'password',
    ];

    protected $casts = [
        'meta' => 'array',
    ];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function members()
    {
        return $this->belongsToMany(User::class, 'zoom_meeting_candidates', 'meeting_id', 'user_id');
    }

    public static $rules = [
        'topic'             => 'required',
        'start_time'        => 'required',
        'duration'          => 'required',
        'host_video'        => 'required',
        'participant_video' => 'required',
        'members'           => 'required|array',
        'agenda'            => 'required',
    ];

    /**
     * @return string
     */
    public function getStatusTextAttribute()
    {
        return self::status[$this->status];
    }
}
