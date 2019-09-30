<?php

namespace App\Entity;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;

/**
 * @property int $id
 * @property string $name
 * @property string $phone
 * @property Carbon $created_at
 * @property Carbon $updated_at
 *
 * @property Order[] $orders
 * @method static Builder withPhone(string $phone)
 */
class Client extends Model
{
    protected $fillable = ['name', 'phone'];

    public function orders()
    {
        return $this->hasMany(Order::class);
    }

    public function scopeWithPhone(Builder $query, string $phone)
    {
        return $this->where('phone', $phone);
    }
}
