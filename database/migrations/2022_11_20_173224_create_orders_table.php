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
            $table->string('fullname', 150);
            $table->string('email', 200)->nullable();
            $table->string('address', 250);
            $table->string('phone', 15)->nullable();
            $table->text('note', 5000)->nullable();
            $table->string('name_product', 150);
            $table->string('code_product', 20);
            $table->string('thumb', 150);
            $table->string('qty', 10);
            $table->string("total_qty", 5);
            $table->string('price', 150);
            $table->string('sub_total_price', 200);
            $table->string('total_price', 150);
            $table->enum('payment', ['payment_home', 'payment_store']);
            $table->enum('status_order', ['is_handle', 'is_transport', 'is_success', 'order_cancel']) ->default('is_handle');
            $table->softDeletes();
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
