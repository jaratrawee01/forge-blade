<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('order_details', function (Blueprint $table) {
            $table->id();
            $table->integer('order_id');    //ออเดอร์
            $table->integer('product_id');  //สินค้า
            $table->string('product_name'); //ชื่อสินค้า
            $table->integer('amount');      //จำนวน
            $table->decimal('price');       //ราคา
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
        Schema::dropIfExists('order_detalls');
    }
};
