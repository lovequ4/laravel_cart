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
        Schema::create('orders', function (Blueprint $table) {
            $table->id();
            $table->integer('total'); 
            $table->unsignedBigInteger('user_id'); 
            $table->string('status'); // Order status 
            $table->string('payment_id')->nullable(); 
            $table->text('shipping_address'); //收件地址
            $table->text('billing_address')->nullable(); //帳單地址
            $table->string('phone');
            $table->timestamps(); 
    
            $table->foreign('user_id')->references('id')->on('users'); 
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('orders');
    }
};
