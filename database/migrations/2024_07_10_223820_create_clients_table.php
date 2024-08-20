<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateClientsTable extends Migration {

	public function up()
	{
		Schema::create('clients', function(Blueprint $table) {
			$table->increments('id');
			$table->timestamps();
			$table->string('phone');
			$table->string('email');
			$table->string('password');
			$table->string('api_token', 80)->unique()->nullable();
            $table->string('0', 80)->unique()->nullable();
			$table->string('name');
			$table->date('birth_date');
			$table->integer('blood_type_id')->unsigned();
			$table->date('last_donation');
            $table->boolean('is_active')->default(1);
			$table->integer('city_id')->unsigned();
			$table->integer('pin_code')->nullable();
		});
	}

	public function down()
	{
		Schema::drop('clients');
	}
}
