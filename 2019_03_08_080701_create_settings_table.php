<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateSettingsTable extends Migration {

	public function up()
	{
		Schema::create('settings', function(Blueprint $table) {
			$table->increments('id');
			$table->timestamps();
			$table->integer('phone');
			$table->string('email', 150);
			$table->string('app_url', 150);
			$table->string('Face_book_url', 150);
			$table->string('twitter_url', 150);
			$table->string('google_url', 150);
			$table->string('whatsup_url', 150);
			$table->string('googleplus_url', 150);
			$table->string('youtube_url', 150);
			$table->string('insta_url', 150);
		});
	}

	public function down()
	{
		Schema::drop('settings');
	}
}