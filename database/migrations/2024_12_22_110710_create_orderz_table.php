<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateOrderzTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('orders', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('phone_number');
            $table->decimal('total_amount', 8, 2);
            $table->string('payment_method');
            $table->string('status')->default('pending');
            $table->timestamps();
        });
    }
    
    
    public function down()
    {
        Schema::dropIfExists('orders');
    }
    

    /**
     * Reverse the migrations.
     *
     * @return void
     */
   
}
