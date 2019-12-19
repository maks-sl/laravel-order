<?php

namespace App\Http\Resources\Countries;

use Illuminate\Http\Resources\Json\JsonResource;

/**
 * @property int $id
 * @property string $name
 *
 */
class CountryResource extends JsonResource
{
    public function toArray($request): array
    {
        return [
            'id' => $this->id,
            'name' => $this->name,
        ];
    }
}
