<?php

namespace App\Services;

use App\Models\Order;
use Carbon\Carbon;
use Illuminate\Pagination\LengthAwarePaginator;

class OrderService
{
    private Order $order;

    private Carbon $carbon;

    public function __construct(Order $order, Carbon $carbon)
    {
        $this->order = $order;
        $this->carbon = $carbon;
    }

    public function getOrdersByUser(int $userId, array $filters = []): LengthAwarePaginator
    {
        return $this->order
            ->with(['product', 'paymentProvider', 'transaction'])
            ->when(
                array_key_exists('payment_provider_ids', $filters) && count($filters) > 0,
                function ($query) use ($filters) {
                    $query->whereIn('payment_provider_id', $filters['payment_provider_ids']);
                }
            )
            ->where('user_id', $userId)
            ->orderByDesc('id')
            ->paginate(2);
    }

    public function createOrder(array $checkoutData): ?Order
    {
        return $this->order->create($checkoutData);
    }

    public function generateOrderNumber(int $userId, int $productId)
    {
        $now = $this->carbon->now();

        return $now->format('Ymd').$now->timestamp;
    }
}
