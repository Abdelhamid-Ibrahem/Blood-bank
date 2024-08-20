<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreatenotificationtokensTable extends Migration {

	public function up()
	{
        Schema::create('notification_tokens', function (Blueprint $table) {
            $table->id();

            $table->foreignId('user_id');

            $table->string('device_token')->unique();
            $table->string('device_id');
            $table->string('device_type');
            $table->unique(['device_id', 'device_type']);

            $table->timestamps();
        });
	}

	public function down()
	{
		Schema::drop('notification_tokens');
	}
}
