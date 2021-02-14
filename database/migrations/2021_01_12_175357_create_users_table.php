<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('users', function (Blueprint $table) {
            $table->id();
            $table->string('first_name',128)->nullable();
            $table->string('insertion',20)->nullable();
            $table->string('last_name',128)->nullable();
            $table->enum('gender', ['MALE','FEMALE','OTHER']);
            $table->string('email',255)->unique();
            $table->timestamp('email_verified_at')->nullable();
            $table->string('phone_number',32)->nullable();
            $table->string('street',255)->nullable();
            $table->string('house_number',20)->nullable();
            $table->string('zipcode',16)->nullable();
            $table->string('city',64)->nullable();
            $table->string('country',2)->nullable();
            $table->string('iban',255)->nullable();
            $table->string('company',128)->nullable();
            $table->string('vat_number',50)->nullable();
            $table->date('date_of_birth')->nullable();
            $table->unsignedTinyInteger('has_accepted_terms')->default('0')->nullable('false');
            $table->string('custom_field_1',255)->nullable();
            $table->string('custom_field_2',255)->nullable();
            $table->enum('user_type_id',['BOER','BURGER','ADMIN'])->default('BURGER')->references('id')->on('user_type');
            $table->string('password');
            $table->rememberToken();
            $table->string('avatar',255)->nullable();
            $table->softDeletes('deleted_at',  0);
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
        Schema::dropIfExists('users');
    }
}
