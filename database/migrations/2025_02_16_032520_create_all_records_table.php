<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
		Schema::create('all_records', function (Blueprint $table) {
			$table->id();
			$table->date('date_made')->nullable();
			$table->date('date_due')->nullable();
			$table->string('r_id', 32)->unique();
			$table->string('ref', 64)->nullable();
			$table->string('user', 255)->nullable();
			$table->unsignedBigInteger('p_id')->nullable();
			$table->foreign('p_id')->references('id')->on('projects')->onDelete('cascade');			
			$table->string('method', 255)->nullable();
			$table->string('type', 255)->nullable();
			$table->string('from', 255)->nullable();
			$table->string('to', 255)->nullable();
			$table->string('ship', 255)->nullable();
			$table->text('note')->nullable()->nullable();
			$table->text('terms')->nullable()->nullable();
			$table->decimal('total', 10, 2)->nullable();
			$table->decimal('tax', 10, 2)->nullable();
			$table->decimal('discount', 10, 2)->nullable();
			$table->decimal('paid', 10, 2)->nullable();
			$table->decimal('dues', 10, 2)->nullable();
			$table->timestamps();
		});
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('all_records');
    }
};
