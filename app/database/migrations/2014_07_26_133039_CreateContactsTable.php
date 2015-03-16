<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateContactsTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('contacts', function(Blueprint $table)
		{
            $table->increments('id');
            $table->string('name')->default('unknown');
            $table->string('number');
            $table->unsignedInteger('user_id');
            $table->timestamps();

            $table->foreign('user_id')->
                references('id')->
                on('users')->
                onDelete('cascade');

        });
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
        Schema::drop('contacts');
	}

}
