<?php

namespace App\Models;

use App\Traits\ImageTrait;
use Eloquent;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Carbon;
use Storage;

/**
 * App\Models\Setting
 *
 * @property int $id
 * @property string $key
 * @property string $value
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 * @method static Builder|Setting newModelQuery()
 * @method static Builder|Setting newQuery()
 * @method static Builder|Setting query()
 * @method static Builder|Setting whereCreatedAt($value)
 * @method static Builder|Setting whereId($value)
 * @method static Builder|Setting whereKey($value)
 * @method static Builder|Setting whereUpdatedAt($value)
 * @method static Builder|Setting whereValue($value)
 * @mixin Eloquent
 */
class Setting extends Model
{
    use ImageTrait;

    protected $table = 'settings';

    protected $fillable = ['key', 'value'];

    public const PATH = 'setting';
    public const PWA_PATH = 'setting/pwa';
    public const THUMB_PATH = 'setting/thumbnails';
    public const NOTIFICATION_SOUND_PATH = 'setting/notification-sound';

    /**
     * @param $value
     * @param string $path
     *
     * @return string
     */
    public function getLogoUrl($value, $path = self::PATH)
    {
        if (! empty($value)) {
            return $this->imageUrl($path.DIRECTORY_SEPARATOR.$value);
        }

        return $value;
    }
    
    /**
     * @param $value
     * @param string $path
     *
     * @return string
     */
    public function getPWAIcon($value)
    {
        if (! empty($value)) {
            return $this->urlEncoding(Storage::disk('pwa')->url($value));
        }

        return $value;
    }

    /**
     * @param $value
     * @param string $path
     *
     * @return string
     */
    public function getNotificationSound($value, $path = self::NOTIFICATION_SOUND_PATH)
    {
        if (! empty($value)) {
            return $this->imageUrl($path.DIRECTORY_SEPARATOR.$value);
        }

        return $value;
    }
}
