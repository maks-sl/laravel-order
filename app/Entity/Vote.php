<?php

namespace App\Entity;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

/**
 * @property int $id
 * @property int $department_id
 * @property int $winner_id
 * @property Carbon $created_at
 * @property Carbon $updated_at
 *
 * @property Department $department
 * @property Department $winner
 */
class Vote extends Model
{

    public function department()
    {
        return $this->belongsTo(Department::class);
    }

    public function winner()
    {
        return $this->belongsTo(Department::class);
    }
}
