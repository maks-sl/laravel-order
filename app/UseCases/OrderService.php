<?php

namespace App\UseCases;

use App\Entity\Client;
use App\Entity\Order;
use App\Entity\Tariff;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Throwable;

class OrderService
{
    /**
     * Create Order
     *
     * @param Request $request
     * @return mixed
     * @throws Exception|Throwable
     * @static
     */
    public function create(Request $request): Order
    {
        $tariff = Tariff::findOrFail($request['tariff']);

        return DB::transaction(function () use ($request, $tariff) {

            if (!$client = Client::withPhone($request['phone'])->first()) {
                $client = Client::create([
                    'phone' => $request['phone'],
                    'name' => $request['name'],
                ]);
            }

            /** @var Order $order */
            $order = Order::make([
                'buyer_name' => $request['name'],
                'address' => $request['address'],
                'delivery_date' => $request['date'],
            ]);

            $order->client()->associate($client);
            $order->tariff()->associate($tariff);

            $order->saveOrFail();
            return $order;
        });
    }

}
