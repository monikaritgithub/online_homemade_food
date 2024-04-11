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
        Schema::create('order_items', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('customer_id');
            $table->unsignedBigInteger('chef_id');
            $table->unsignedBigInteger('food_id');
            $table->string('payment_method');
            $table->string('txn_id')->nullable();
            $table->string('payment_status')->default('pending');
            $table->integer('quantity')->default(1);
            $table->decimal('price', 10, 2);
            $table->string('status')->default(0);
            $table->timestamps();

            // Define foreign key constraints
            // $table->foreign('food_id')->references('id')->on('products');
            // $table->foreign('order_by')->references('id')->on('users');
            // $table->foreign('order_to')->references('id')->on('users');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('orderitems');
    }
};





