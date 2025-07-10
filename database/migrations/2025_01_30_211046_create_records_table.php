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
        if (Schema::hasTable('records')) {
            return;
        }
        // Schema::create('records', function (Blueprint $table) {
        //     $table->id();
        //     $table->date('date_made')->nullable();
        //     $table->date('date_due')->nullable();
        //     $table->string('ref_id')->nullable();
        //     $table->string('user')->nullable();
        //     $table->string('p_id')->nullable();
        //     $table->string('method')->nullable();
        //     $table->string('type')->nullable();
        //     // Shipping details
        //     $table->string('from')->nullable();
        //     $table->string('to')->nullable();
        //     $table->string('ship')->nullable();
        //     // Items and pricing
        //     $table->string('item_1')->nullable();
        //     $table->integer('qty_1')->nullable();
        //     $table->decimal('rate_1', 10, 2)->nullable();

        //     $table->string('item_2')->nullable();
        //     $table->integer('qty_2')->nullable();
        //     $table->decimal('rate_2', 10, 2)->nullable();

        //     $table->string('item_3')->nullable();
        //     $table->integer('qty_3')->nullable();
        //     $table->decimal('rate_3', 10, 2)->nullable();

        //     // Additional details
        //     $table->text('note')->nullable();
        //     $table->text('terms')->nullable();
        //     // Financial details
        //     $table->decimal('total', 10, 2)->default(0.00);
        //     $table->decimal('tax', 10, 2)->nullable();
        //     $table->decimal('discount', 10, 2)->nullable();
        //     $table->decimal('paid', 10, 2)->nullable();
        //     $table->decimal('dues', 10, 2)->default(0.00);

        //     $table->timestamps();
        // });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('records');
    }
};
