<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProductTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('product', function (Blueprint $table) {
            $table->id();
            $table->string('name', 255)->nullable('false');
            $table->text('description')->nullable();
            $table->decimal('price', 12, 2)->nullable('false');
            $table->unsignedTinyInteger('is_active')->default('0')->nullable('false');
            $table->smallInteger('min_order_amount')->nullable('false')->unsigned();
            $table->smallInteger('max_order_amount')->nullable('false')->unsigned();
            $table->Integer('stock')->nullable('false')->unsigned();
            $table->smallInteger('display_order')->nullable('false')->unsigned();
            $table->date('online_from')->nullable();
            $table->date('online_until')->nullable();
            $table->foreignId('shop_id')->constrained('shop');
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
        Schema::dropIfExists('product');
    }
}
