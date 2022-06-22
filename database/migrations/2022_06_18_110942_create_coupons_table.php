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
        Schema::create('coupons', function (Blueprint $table) {
            $table->bigIncrements('coupon_id');
            $table->string('coupon_title',100)->nullable();
            $table->string('coupon_code',50)->nullable();
            $table->date('coupon_starting')->nullable();
            $table->date('coupon_ending')->nullable();
            $table->string('coupon_remarks',250)->nullable();
            $table->integer('coupon_creator')->nullable();
            $table->integer('coupon_editor')->nullable();
            $table->string('coupon_slug')->uniqid();
            $table->integer('coupon_status')->default(1);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('coupons');
    }
};
