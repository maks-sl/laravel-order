<?php

namespace App\Http\Resources\Orders;

use Illuminate\Http\Resources\Json\JsonResource;

/**
 * @property int $id
 *
 */
class DetailResource extends JsonResource
{
    public function toArray($request): array
    {
        return [
            'id' => $this->id,
        ];
    }
}
