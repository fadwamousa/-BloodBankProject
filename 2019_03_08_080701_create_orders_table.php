<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateOrdersTable extends Migration {

	public function up()
	{
		Schema::create('orders', function(Blueprint $table) {
			$table->increments('id');
			$table->timestamps();
			$table->string('name_order', 150);
			$table->integer('age');
			$table->integer('number_bags');
			$table->string('name_hospital', 150);
			$table->decimal('latitude', 10,8);
			$table->decimal('longtitude', 10,8);
			$table->integer('phone');
			$table->integer('type_id')->unsigned();
			$table->string('address', 150);
			$table->integer('city_id')->unsigned();
			$table->integer('client_id')->unsigned();
		});
	}

	public function down()
	{
		Schema::drop('orders');
	}
}