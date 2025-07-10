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
        Schema::create('record_items', function (Blueprint $table) {
            $table->id();
            // $table->foreignId('r_id')->constrained('all_records')->onDelete('cascade'); // table Links to all_records table. Automatically links record_id to the id column of the all_records 
            //$table->foreign('r_id')->constrained('all_records')->onDelete('cascade'); 
            $table->string('r_id', 32); // Define r_id as a string
            $table->foreign('r_id')->references('r_id')->on('all_records')->onDelete('cascade');
            $table->string('item_id');
            $table->string('particular'); // Item name
            $table->integer('quantity');
            $table->decimal('rate', 10, 2);
            $table->decimal('total', 10, 2);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('record_items');
    }
};
