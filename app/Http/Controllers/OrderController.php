<?php

namespace App\Http\Controllers;

use App\Entity\Tariff;
use App\UseCases\OrderService;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

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

    public function store(Request $request)
    {
        $this->validate($request, [
            'name' => 'required|string|max:255',
            'phone' => 'required|string|max:255',
            'address' => 'required|string|max:1023',
            'tariff' => ['required', 'integer', Rule::exists('tariffs', 'id')],
            'date' => 'required|date|after:today',
        ]);

        try {
            $order = $this->orders->create($request);
        } catch (\Throwable $e) {
            return back()->with('error', 'Order creating error');
        }
        return redirect()->route('welcome')->with('status', 'Order #'.$order->id. ' was received');
    }
}
