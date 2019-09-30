<?php

namespace App\Http\Controllers;

use App\Entity\Tariff;
use App\UseCases\OrderService;
use App\Http\Requests\Order\CreateRequest;
use Throwable;

class OrderController extends Controller
{
    private $orders;

    public function __construct(OrderService $orders)
    {
        $this->orders = $orders;
    }

    public function create()
    {
        $tariffs = Tariff::all();
        return view('order.create', compact('tariffs'));
    }

    public function store(CreateRequest $request)
    {
        try {
            $order = $this->orders->create($request);
        } catch (Throwable $e) {
            return back()->with('error', 'Order creating error');
        }
        return redirect()->route('welcome')->with('status', 'Order #'.$order->id. ' was received');
    }
}
