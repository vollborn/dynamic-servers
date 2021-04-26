<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateServersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('servers', function (Blueprint $table) {
            $table->id();
            $table->unsignedInteger('notification_channel_limit')
                ->default(config('servers.notification_channel_limit'));

            $table->foreignId('user_id');
            $table->string('name');

            $table->string('ip_address')->nullable();
            $table->text('ip_address_details')->nullable();

            $table->string('server_token');
            $table->string('request_token');
            $table->integer('request_interval');

            $table->text('custom_labels')->nullable();
            $table->foreignId('background_image_id');

            $table->dateTime('last_seen_at')->nullable();
            $table->dateTime('last_updated_at')->nullable();
            $table->dateTime('disabled_at')->nullable();
            $table->timestamps();
            $table->softDeletes();

            $table->foreign('user_id')->references('id')->on('users');
            $table->foreign('background_image_id')->references('id')->on('background_images');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('servers');
    }
}
