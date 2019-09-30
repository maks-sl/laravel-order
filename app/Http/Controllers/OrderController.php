<?php

namespace App\Http\Controllers;

use App\Entity\Tariff;
use App\Http\Resources\Orders\DetailResource;
use App\UseCases\OrderService;
use App\Http\Requests\Order\CreateRequest;
use Illuminate\Http\Response;
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

    public function apiCreate()
    {
        return view('order.api-create');
    }

    public function apiStore(CreateRequest $request)
    {
        try {
            $order = $this->orders->create($request);
        } catch (Throwable $e) {
            return response()
                ->setStatusCode(Response::HTTP_INTERNAL_SERVER_ERROR)
                ->json(['errors' => 'Order creating error']);
        }
        return (new DetailResource($order))
            ->response()
            ->setStatusCode(Response::HTTP_CREATED);
    }
}
