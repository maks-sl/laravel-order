<?php

namespace App\Entity;

use Illuminate\Database\Eloquent\Model;

/**
 * @property int $id
 * @property string $status
 */
class Poll extends Model
{
    const STATUS_PAUSED = 0;
    const STATUS_STARTED = 1;

    public $timestamps = false;

    protected $fillable = ['status'];

    public function start(): void {
        $this->status = self::STATUS_STARTED;
    }

    public function pause(): void {
        $this->status = self::STATUS_PAUSED;
    }

}
