<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePaymentMethodShopTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('payment_method_shop', function (Blueprint $table) {
            $table->id();
            $table->foreignId('payment_method_id')->constrained('payment_method');
            $table->foreignId('shop_id')->constrained('shop');
            $table->unsignedTinyInteger('is_active')->default('0')->nullable('false');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('payment_method_shop');
    }
}
