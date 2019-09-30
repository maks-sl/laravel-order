<?php

namespace App\Http\Resources\Tariffs;

use Carbon\Carbon;
use Illuminate\Http\Resources\Json\JsonResource;

/**
 * @property int $id
 * @property string $name
 * @property int $price
 * @property array $allowed_days
 *
 */
class TariffResource extends JsonResource
{
    public function toArray($request): array
    {
        return [
            'id' => $this->id,
            'name' => $this->name,
            'price' => $this->price,
            'days' => implode(', ', array_map(function ($day) {
                return Carbon::getDays()[$day];
            }, $this->allowed_days)),
        ];
    }
}
