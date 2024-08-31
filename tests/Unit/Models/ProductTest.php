<?php

namespace Tests\Unit\Models;

use App\Enums\CardAssociationEnums;
use App\Enums\CardFamilyEnums;
use App\Enums\CardTypeEnums;
use App\Models\Order;
use App\Models\PaymentProvider;
use App\Models\Product;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Collection;
use Tests\TestCase;

class ProductTest extends TestCase
{
    private Order $order;

    public function setUp(): void
    {
        parent::setUp();

        $user = User::query()->find(1);
        $paymentProvider = PaymentProvider::query()->find(1);
        $product = Product::query()->find(1);

        $checkoutRequest = [
            'order_number' => Carbon::now()->format('Ymd').Carbon::now()->timestamp + fake()->numberBetween(999, 99999),
            'user_id' => $user->id,
            'payment_provider_id' => $paymentProvider->id,
            'product_id' => $product->id,
            'expire_month' => Carbon::now()->format('m'),
            'expire_year' => Carbon::now()->format('Y'),
            'card_number' => '5526080000000006',
            'cvc' => '111',
            'card_holdername' => fake()->name(),
            'installment' => fake()->randomElement([1, 2, 3, 6, 9, 12]),
            'shipping_address' => fake()->address(),
            'billing_address' => fake()->address(),
            'quantity' => fake()->randomDigitNotZero(),
            'unit_price' => $product->price,
            'currency' => $product->currency,
        ];

        $this->order = Order::query()->create($checkoutRequest);
        $this->order->transaction()->create([
            'bin_number' => '123456',
            'card_type' => CardTypeEnums::CREDIT_CARD,
            'card_association' => CardAssociationEnums::AMERICAN_EXPRESS,
            'card_family' => CardFamilyEnums::ADVANTAGE,
        ]);
    }

    /**
     * @test
     * @return void
     */
    public function it_should_have_has_many_relation_with_order(): void
    {
        $product = Product::query()->find(1);

        $this->assertInstanceOf(Collection::class, $product->orders);
    }
}
