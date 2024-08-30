<?php

namespace App\Services;

use App\Models\Order;
use Carbon\Carbon;

class OrderService
{
    private Order $order;
    private Carbon $carbon;

    /**
     * @param Order $order
     */
    public function __construct(Order $order, Carbon $carbon)
    {
        $this->order = $order;
        $this->carbon = $carbon;
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
