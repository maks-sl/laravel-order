<?php

namespace App\Http\Resources\Tariffs;

use Carbon\Carbon;
use Illuminate\Http\Resources\Json\JsonResource;

/**
 * @property-read int $dayOfWeek 0 (for Sunday) through 6 (for Saturday)
 * @method string toDateString()
 *
 */
class DateDetailResource extends JsonResource
{
    public function toArray($request): array
    {
        return [
            'date' => $this->toDateString(),
            'human' => $this->toDateString().' ('.Carbon::getDays()[$this->dayOfWeek].')',
        ];
    }
}
