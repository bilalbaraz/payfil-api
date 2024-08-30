<?php

use App\Enums\CardAssociationEnums;
use App\Enums\CardFamilyEnums;
use App\Enums\CardTypeEnums;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('transactions', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('order_id');
            $table->integer('bin_number');
            $table->enum(
                'card_type',
                [CardTypeEnums::CREDIT_CARD, CardTypeEnums::DEBIT_CARD, CardTypeEnums::PREPAID_CARD]
            );
            $table->enum(
                'card_association',
                [
                    CardAssociationEnums::VISA,
                    CardAssociationEnums::MASTER_CARD,
                    CardAssociationEnums::AMERICAN_EXPRESS,
                    CardAssociationEnums::TROY,
                ]
            );
            $table->enum(
                'card_family',
                [
                    CardFamilyEnums::BONUS,
                    CardFamilyEnums::AXESS,
                    CardFamilyEnums::WORLD,
                    CardFamilyEnums::MAXIMUM,
                    CardFamilyEnums::PARAF,
                    CardFamilyEnums::CARD_FINANS,
                    CardFamilyEnums::ADVANTAGE,
                ]
            );
            $table->softDeletes();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('transactions');
    }
};
