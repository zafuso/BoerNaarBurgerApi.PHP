<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePayoutTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('payout', function (Blueprint $table) {
            $table->id();
            $table->string('external_id', 128)->nullable('false');
            $table->foreignId('payment_method_id')->constrained('payment_method');
            $table->foreignId('user_id')->constrained('users')->nullable('false');
            $table->decimal('balance', 12, 2)->nullable('false');
            $table->enum('status', ['COMPLETED', 'CANCELED', 'OPEN', 'REFUNDED'])->nullable('false');
            $table->date('paid_at')->nullable();
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
        Schema::dropIfExists('payout');
    }
}
