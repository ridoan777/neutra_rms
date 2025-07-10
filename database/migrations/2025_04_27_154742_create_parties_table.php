<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePartiesTable extends Migration
{
	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('parties', function (Blueprint $table)
		{
			$table->id();
			$table->string('type')->default('supplier');
			$table->string('prt_id')->unique();
			$table->string('name');
			$table->decimal('openingBal', 15, 2)->default(0.00);
			$table->decimal('currentBal', 15, 2)->default(0.00);
			$table->string('country'); // Store country as a JSON array
			$table->string('state');
			$table->string('address')->nullable();
			$table->string('user');
			$table->string('updator')->nullable();
			$table->string('description', 255)->nullable();
			$table->string('image')->nullable();
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
		Schema::dropIfExists('parties');
	}
}
