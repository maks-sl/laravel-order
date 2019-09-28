<?php

namespace App\Entity;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;
use LogicException;

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

    public function allowedDates(): array
    {
        if (!empty(array_diff($this->allowed_days, array_keys(Carbon::getDays()))) or empty($this->allowed_days)) {
            throw new LogicException('Invalid tariff allowed_date');
        }
        $now = Carbon::now();
        $allowedDays = array_sort($this->allowed_days);
        $nowDay = $now->dayOfWeek;
        $dates = [];

        if (in_array($nowDay, $this->allowed_days)) {
            $dates[] = $now->toDateString();
        }
        foreach ($allowedDays as $i => $d) {
            if ($d > $nowDay) {
                $seek = $i;
                break;
            }
        }
        if (!isset($seek)) { $seek = 0; }

        $current = clone $now;
        $limitDate = (clone $now)->addMonth();
        while (count($dates) < 31) {
            if ($seek >= count($allowedDays)) { $seek = 0; }
            $current->next($allowedDays[$seek]);
            if ($current->greaterThanOrEqualTo($limitDate)) {
                break;
            }
            $dates[] = $current->toDateString();
            $seek++;
        }
        return $dates;
    }
}
