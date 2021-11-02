<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateBillingAmountsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('billing_amounts', function (Blueprint $table) {
            $table->id();
            $table->foreignId('billing_detail_id');
            $table->integer('subtotal');
            $table->integer('discount')->comment('Persentage %');
            $table->string('coupon_name')->nullable();
            $table->integer('shipping');
            $table->integer('grand_total');
            $table->string('payment_status')->default('unpaid')->comment('unpaid, paid');
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('billing_amounts');
    }
}
