<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateOrderItemTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('order_item', function (Blueprint $table) {
            $table->id();
            $table->string('order_id', 10)->nullable('false')->references('order_id')->on('order');
            $table->string('barcode', 20)->unique()->nullable('false');
            $table->Integer('serial_number')->nullable('false')->unsigned();
            $table->decimal('order_item_price', 12, 2)->nullable('false');
            $table->enum('status', ['COMPLETED','CANCELED','OPEN'])->nullable('false');
            $table->foreignId('product_id')->constrained('product');
            $table->timestamps();
            $table->softDeletes('deleted_at',  0);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('order_item');
    }
}
