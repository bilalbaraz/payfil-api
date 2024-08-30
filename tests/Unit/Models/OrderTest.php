<?php

namespace Tests\Unit\Model;

use App\Enums\CardAssociationEnums;
use App\Enums\CardFamilyEnums;
use App\Enums\CardTypeEnums;
use App\Models\Order;
use App\Models\PaymentProvider;
use App\Models\Product;
use App\Models\Transaction;
use App\Models\User;
use Carbon\Carbon;
use Tests\TestCase;

class OrderTest extends TestCase
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
    public function it_should_have_belongs_to_relation_with_product(): void
    {
        $this->assertInstanceOf(Product::class, $this->order->product);
        $this->assertNotNull($this->order->product);
    }

    /**
     * @test
     * @return void
     */
    public function it_should_have_belongs_to_relation_with_payment_provider(): void
    {
        $this->assertInstanceOf(PaymentProvider::class, $this->order->paymentProvider);
        $this->assertNotNull($this->order->paymentProvider);
    }

    /**
     * @test
     * @return void
     */
    public function it_should_have_total_amount(): void
    {
        $this->assertNotNull($this->order->total_amount);
        $this->assertEquals($this->order->total_amount, $this->order->unit_price * $this->order->quantity);
    }

    /**
     * @test
     * @return void
     */
    public function it_should_have_belongs_to_relation_with_user(): void
    {
        $this->assertInstanceOf(User::class, $this->order->user);
        $this->assertNotNull($this->order->user);
    }

    /**
     * @test
     * @return void
     */
    public function it_should_have_belongs_to_relation_with_transaction(): void
    {
        $this->assertInstanceOf(Transaction::class, $this->order->transaction);
        $this->assertNotNull($this->order->transaction);
    }
}
