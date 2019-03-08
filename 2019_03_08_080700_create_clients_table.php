<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateClientsTable extends Migration {

	public function up()
	{
		Schema::create('clients', function(Blueprint $table) {
			$table->increments('id');
			$table->timestamps();
			$table->string('phone', 30);
			$table->string('password', 150);
			$table->string('password_confirm', 150);
			$table->string('name', 150);
			$table->string('email', 200);
			$table->date('date_birth');
			$table->integer('type_id')->unsigned();
			$table->date('last_date_request');
			$table->string('token', 150)->nullable();
			$table->string('api_token', 150)->uniqid()->nullable();
			$table->integer('city_id')->unsigned();
		});
	}

	public function down()
	{
		Schema::drop('clients');
	}
}