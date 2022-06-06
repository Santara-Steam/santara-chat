<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * App\Models\UserDevice
 *
 * @property int $id
 * @property int $user_id
 * @property string $player_id
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\UserDevice newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\UserDevice newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\UserDevice query()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\UserDevice whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\UserDevice whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\UserDevice wherePlayerId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\UserDevice whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\UserDevice whereUserId($value)
 * @mixin \Eloquent
 */
class UserDevice extends Model
{
    protected $table = 'user_devices';

    protected $fillable = [
        'player_id',
        'user_id',
    ];

    protected $casts = [
        'user_id'   => 'integer',
        'player_id' => 'string',
    ];
}
