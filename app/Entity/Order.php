<?php

namespace App\Entity;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

/**
 * @property int $id
 * @property string $buyer_name
 * @property string $address
 * @property Carbon $delivery_date
 * @property int $client_id
 * @property int $tariff_id
 * @property Carbon $created_at
 * @property Carbon $updated_at
 *
 * @property Tariff $tariff
 * @property Client $client
 */
class Order extends Model
{
    protected $fillable = ['buyer_name', 'address', 'delivery_date'];

    protected $casts = [
        'delivery_date' => 'date:Y-m-d',
    ];

    public function tariff()
    {
        return $this->belongsTo(Tariff::class);
    }

    public function client()
    {
        return $this->belongsTo(Client::class);
    }
}
