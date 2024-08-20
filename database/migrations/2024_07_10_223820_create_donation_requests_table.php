<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateDonationRequestsTable extends Migration {

	public function up()
	{
		Schema::create('donation_requests', function(Blueprint $table) {
			$table->increments('id');
			$table->timestamps();
            $table->integer('client_id')->unsigned();
			$table->string('patient_name');
            $table->integer('patient_age');
			$table->string('patient_phone');
			$table->integer('city_id')->unsigned();
			$table->string('hospital_name');
			$table->integer('blood_type_id')->unsigned();
			$table->integer('bags_num');
			$table->string('hospital_address');
			$table->text('details')->nullable();
			$table->decimal('latitude', 10,8)->nullable();
			$table->decimal('longitude', 10,8)->nullable();

		});
	}

	public function down()
	{
		Schema::drop('donation_requests');
	}
}
