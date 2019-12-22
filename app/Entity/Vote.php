<?php

namespace App\Entity;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

/**
 * @property int $id
 * @property int $department_id
 * @property int $country_id
 * @property string $finger_hash
 * @property string $platform
 * @property string $ip
 * @property string $user_agent
 * @property Carbon $created_at
 * @property Carbon $updated_at
 *
 * @property Department $department
 * @property Country $country
 */
class Vote extends Model
{

    protected $fillable = ['finger_hash', 'platform', 'ip', 'user_agent'];

    public function department()
    {
        return $this->belongsTo(Department::class);
    }

    public function country()
    {
        return $this->belongsTo(Country::class);
    }
}
