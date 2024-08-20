<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateBloodTypesTable extends Migration {

	public function up()
	{
		Schema::create('blood_types', function(Blueprint $table) {
			$table->increments('id');
			$table->timestamps();
			$table->string('name');
            $table->integer('clientable_id');
            $table->string('clientable_type');
		});
	}

	public function down()
	{
		Schema::drop('blood_types');
	}
}
