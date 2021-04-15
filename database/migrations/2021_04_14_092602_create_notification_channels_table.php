<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateNotificationChannelsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('notification_channels', function (Blueprint $table) {
            $table->id();

            $table->foreignId('server_id');
            $table->unsignedInteger('notification_channel_type_id');
            $table->text('content');

            $table->timestamps();
            $table->softDeletes();

            $table->foreign('server_id')->references('id')->on('servers');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('notification_channels');
    }
}
