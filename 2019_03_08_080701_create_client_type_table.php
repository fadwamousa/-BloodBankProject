<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateClientTypeTable extends Migration {

	public function up()
	{
		Schema::create('client_type', function(Blueprint $table) {
			$table->increments('id');
			$table->timestamps();
			$table->integer('client_id')->unsigned();
			$table->integer('type_id')->unsigned();
		});
	}

	public function down()
	{
		Schema::drop('client_type');
	}
}