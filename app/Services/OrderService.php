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
                array_key_exists('payment_provider_ids', $filters) && count($filters['payment_provider_ids']) > 0,
                function ($query) use ($filters) {
                    $query->whereIn('payment_provider_id', $filters['payment_provider_ids']);
                }
            )
            ->when(
                array_key_exists('starts_at', $filters),
                function ($query) use ($filters) {
                    $query->whereDate('created_at', '>=', $filters['starts_at']);
                }
            )
            ->when(
                array_key_exists('ends_at', $filters),
                function ($query) use ($filters) {
                    $query->whereDate('created_at', '<=', $filters['ends_at']);
                }
            )
            ->when(
                array_key_exists('currencies', $filters) && count($filters['currencies']) > 0,
                function ($query) use ($filters) {
                    $query->whereIn('currency', $filters['currencies']);
                }
            )
            ->where('user_id', $userId)
            ->orderByDesc('id')
            ->paginate(10);
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
