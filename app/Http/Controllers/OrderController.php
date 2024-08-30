<?php

namespace App\Http\Controllers;
use App\Http\Requests\Order\OrderCheckoutRequest;
use App\Http\Requests\Order\OrderFilterRequest;

class OrderController extends Controller
{
    public function index(OrderFilterRequest $request)
    {
        $filters = $request->validated();
        $orders = [];

        return response()->json(['success' => true, 'orders' => $orders]);
    }

    public function checkout(OrderCheckoutRequest $request)
    {
        $data = $request->validated();

        return response()->json(['success' => true]);
    }
}
