<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateShopTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('shop', function (Blueprint $table) {
            $table->id();
            $table->string('name', 255)->nullable('false');
            $table->text('description')->nullable();
            $table->unsignedTinyInteger('is_active')->default('0')->nullable('false');
            $table->date('online_from')->nullable();
            $table->date('online_until')->nullable();
            $table->string('shop_banner', 255)->nullable();
            $table->string('shop_logo', 255)->nullable();
            $table->foreignId('shop_owner_id')->constrained('users');
            $table->foreignId('email_template_id')->constrained('email_template');
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
        Schema::dropIfExists('shop');
    }
}
