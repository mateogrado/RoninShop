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
            $table->bigIncrements('id');

            $table->string('order_number');
            $table->unsignedBigInteger('user_id');
            $table->enum('status', ['pending','procesing','completed','decline'])->default('pending');;
            $table->float('grand_total');
            $table->integer('item_count');
            $table->tinyInteger('is_paid')->default(false);
            $table->enum('payment_method', ['cash_on_delivery', 'paypal', 'stripe','card'])->default('cash_on_delivery');

            $table->string('shipping_fullname');
            $table->string('shipping_address');
            $table->string('shipping_email');
            $table->string('shipping_state');
            $table->string('shipping_zipcode');
            $table->string('shipping_phone');
            $table->string('notes')->nullable();

            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');

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
