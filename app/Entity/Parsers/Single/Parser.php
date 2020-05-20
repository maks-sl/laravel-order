<?php

namespace App\Entity\Parsers\Single;

use App\Entity\User;
use Carbon\Carbon;
use Eloquent;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Builder;

/**
 * @mixin Eloquent
 *
 * @property int $id
 * @property int $user_id
 * @property string $name
 * @property string $status
 * @property string $url
 * @property string $css_path
 * @property string $regex
 * @property int $match_group
 * @property int $period
 * @property bool $strip_tags
 * @property Carbon $created_at
 * @property Carbon $updated_at
 *
 * @property User $user
 * @property Result[] $results
 *
 * @method static Builder forUser(User $user)
 */
class Parser extends Model
{

    const STATUS_PAUSED = 0;
    const STATUS_ACTIVE = 1;

    protected $fillable = ['name', 'status', 'url', 'css_path', 'regex', 'match_group', 'strip_tags', 'period'];

    protected $table = "parser_single";

    // ########### LOGIC #############

    public function isActive(): bool {
        return $this->status == self::STATUS_ACTIVE;
    }

    public function isPaused(): bool {
        return $this->status == self::STATUS_PAUSED;
    }

    public function activate(): void
    {
        $this->update([
            'status' => self::STATUS_ACTIVE,
        ]);
    }

    public function pause(): void
    {
        $this->update([
            'status' => self::STATUS_PAUSED,
        ]);
    }

    public function isExpired(): bool
    {
        $results_fresh = $this->results()
            ->where(
                'created_at',
                '>=',
                Carbon::now()->subMinutes($this->period)->toDateTimeString());
        return !$results_fresh->exists();
    }

    // ########### RELATIONS #############

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function results()
    {
        return $this->hasMany(Result::class);
    }

    public function scopeForUser(Builder $query, User $user)
    {
        return $query->where('user_id', $user->id);
    }

}
