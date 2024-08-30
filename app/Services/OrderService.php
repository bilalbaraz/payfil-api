<?php

namespace App\Services;

use App\Models\Order;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Collection;

class OrderService
{
    private Order $order;

    private Carbon $carbon;

    public function __construct(Order $order, Carbon $carbon)
    {
        $this->order = $order;
        $this->carbon = $carbon;
    }

    public function getOrdersByUser(int $userId, array $filters = []): Collection
    {
        return $this->order->with(['product', 'paymentProvider'])->where('user_id', $userId)->get();
    }

    public function checkout(array $checkoutData): ?Order
    {
        return $this->order->create($checkoutData);
    }

    public function generateOrderNumber(int $userId, int $productId)
    {
        $now = $this->carbon->now();

        return $now->format('Ymd').$now->timestamp;
    }
}
