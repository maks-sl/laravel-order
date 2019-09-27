<?php

namespace App\Entity;

use Illuminate\Database\Eloquent\Model;

/**
 * @property int $id
 * @property string $name
 * @property string $phone
 *
 * @property Order[] $orders
 */
class Client extends Model
{
    protected $fillable = ['name', 'phone'];

    public function orders()
    {
        return $this->hasMany(Order::class);
    }
}
