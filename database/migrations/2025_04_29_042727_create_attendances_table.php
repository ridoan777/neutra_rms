<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
	public function up(): void
	{
		Schema::create('attendances', function (Blueprint $table) {
			$table->id();
			$table->string('prt_id')->nullable();
			$table->foreign('prt_id')->references('prt_id')->on('parties')->onDelete('cascade');
			$table->string('name')->nullable();
			$table->date('date');
			$table->string('status');
			$table->string('attendee');
			$table->timestamps();
	  });
	}

	public function down(): void
	{
		Schema::dropIfExists('attendances');
	}
};

