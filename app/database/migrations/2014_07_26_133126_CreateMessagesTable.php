<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateMessagesTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('messages', function(Blueprint $table)
		{
            $table->increments('id');
            $table->string('content');
            $table->boolean('is_read')->default(false);
            $table->boolean('is_inbound')->default(true);
            $table->unsignedInteger('contact_id');
            $table->timestamps();

            $table->foreign('contact_id')->
                references('id')->
                on('contacts')->
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
        Schema::drop('messages');
	}

}
