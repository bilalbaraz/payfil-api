<?php

namespace Database\Seeders;

use App\Models\PaymentProvider;
use Illuminate\Database\Seeder;

class PaymentProviderSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $paymentProviders = [
            ['title' => 'Iyzico'],
            ['title' => 'Stripe'],
            ['title' => 'PayPal'],
        ];
        PaymentProvider::query()->truncate();

        foreach ($paymentProviders as $paymentProvider) {
            PaymentProvider::query()->create($paymentProvider);
        }
    }
}
