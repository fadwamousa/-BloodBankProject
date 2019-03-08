<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreatePostsTable extends Migration {

	public function up()
	{
		Schema::create('posts', function(Blueprint $table) {
			$table->increments('id');
			$table->timestamps();
			$table->string('title', 150);
			$table->text('body');
			$table->string('image', 250);
		});
	}

	public function down()
	{
		Schema::drop('posts');
	}
}