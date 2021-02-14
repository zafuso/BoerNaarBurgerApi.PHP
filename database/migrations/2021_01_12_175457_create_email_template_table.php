<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateEmailTemplateTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('email_template', function (Blueprint $table) {
            $table->id();
            $table->string('name', 255)->nullable('false');
            $table->unsignedTinyInteger('is_default')->default('0')->nullable('false');
            $table->unsignedTinyInteger('is_active')->default('0')->nullable('false');
            $table->string('banner_url', 255)->nullable();
            $table->string('logo_url', 255)->nullable();
            $table->text('message_text')->nullable();
            $table->string('subject', 255)->nullable('false');
            $table->string('sender_name', 128)->nullable('false');
            $table->string('sender_email', 128)->nullable('false');
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
        Schema::dropIfExists('email_template');
    }
}
