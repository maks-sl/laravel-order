<?php

namespace App\Entity;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

/**
 * @property int $id
 * @property string $name
 * @property int $price
 * @property array $allowed_days
 *
 */
class Tariff extends Model
{
    public $timestamps = false;

    protected $fillable = ['name', 'price', 'allowed_days'];

    protected $casts = [
        'allowed_days' => 'array',
    ];

//    public function datesList(): array
//    {
//        $now = Carbon::now();
//        $now->addDays();
//        $currentDay = $now->dayOfWeek;
//        if (in_array($currentDay, $this->allowed_days)) {
//            $firstDayDiff = 0;
//        } else {
//
//        }
//    }
}
