<?php

namespace App\Http\Controllers;

use App\Http\Requests\Order\OrderCheckoutRequest;
use App\Http\Requests\Order\OrderFilterRequest;
use App\Services\OrderService;
use App\Services\ProductService;

class OrderController extends Controller
{
    private ProductService $productService;

    private OrderService $orderService;

    public function __construct(ProductService $productService, OrderService $orderService)
    {
        $this->productService = $productService;
        $this->orderService = $orderService;
    }

    public function index(OrderFilterRequest $request)
    {
        $filters = $request->validated();
        $user = $request->user();
        $orders = $this->orderService->getOrdersByUser($user->id, $filters);

        return response()->json(['success' => true, 'count' => $orders->count(), 'orders' => $orders]);
    }

    public function checkout(OrderCheckoutRequest $request)
    {
        $data = $request->validated();
        $user = $request->user();
        $product = $this->productService->getProductByProductId($data['product_id']);
        $orderNumber = $this->orderService->generateOrderNumber($user->id, $product->id);

        $checkoutRequest = [
            'order_number' => $orderNumber,
            'user_id' => $user->id,
            'payment_provider_id' => $data['payment_provider_id'],
            'product_id' => $product->id,
            'expire_month' => $data['expire_month'],
            'expire_year' => $data['expire_year'],
            'card_number' => $data['card_number'],
            'cvc' => $data['cvc'],
            'card_holdername' => $data['card_holdername'],
            'installment' => $data['installment'],
            'shipping_address' => $data['shipping_address'],
            'billing_address' => $data['billing_address'],
            'quantity' => $data['quantity'],
            'unit_price' => $product->price,
            'currency' => $product->currency,
        ];

        $this->orderService->checkout($checkoutRequest);

        return response()->json(['success' => true]);
    }
}
