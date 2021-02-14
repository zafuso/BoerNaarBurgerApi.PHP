<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateOrderTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('order', function (Blueprint $table) {
            $table->string('order_id', 10)->unique()->nullable('false')->primary();
            $table->decimal('order_balance_incl_vat', 12, 2)->nullable('false');
            $table->decimal('order_balance_excl_vat', 12, 2)->nullable('false');
            $table->unsignedTinyInteger('is_completed')->default('0')->nullable('false');
            $table->unsignedTinyInteger('is_canceled')->default('0')->nullable('false');
            $table->unsignedTinyInteger('is_paid')->default('0')->nullable('false');
            $table->foreignId('user_id')->constrained('users');
            $table->date('completed_at')->nullable();
            $table->date('canceled_at')->nullable();
            $table->date('email_send_at')->nullable();
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
        Schema::dropIfExists('order');
    }
}
