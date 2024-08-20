<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreatePostsTable extends Migration {

	public function up()
	{
		Schema::create('posts', function(Blueprint $table) {
			$table->increments('id');
			$table->timestamps();
			$table->string('title');
			$table->string('image')->nullable();
			$table->text('content');
			$table->integer('category_id')->unsigned();
            $table->date('publish_date');
		});
	}

	public function down()
	{
		Schema::drop('posts');
	}
}
