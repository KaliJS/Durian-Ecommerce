<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateOrdersTable extends Migration
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
            $table->bigInteger('user_id')->unsigned();
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
            $table->float('actual_price',8,2);
            $table->float('final_price',8,2);
            $table->float('delivery_charge',8,2);
            $table->enum('payment_method', ['cash', 'paypal']);
            $table->float('latitude',8,2);
            $table->float('longitude',8,2);
            $table->text('address');
            $table->integer('pincode');
            $table->enum('order_status', ['booked', 'shipped','completed','cancelled','returned']);
            $table->enum('payment_status', ['failed', 'pending','success']);
            $table->string('paypal_transaction_id')->nullable();
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
        Schema::dropIfExists('orders');
    }
}
