<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateMstUsersTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('mst_users', function(Blueprint $table)
		{
			$table->increments('id');
            $table->string('password');
            $table->string('account')->unique();
            $table->string('name');
            $table->text('address');
            $table->string('phone');
            $table->string('email')->unique();
            $table->string('is_admin');
			$table->timestamps();
		});
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('mst_users');
	}

}
