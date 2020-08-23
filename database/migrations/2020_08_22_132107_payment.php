<?php

use App\models\Payments;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class Payment extends Migration
{
    /**
     * Run the migrations.
     *
     * @return string
     */


    public function up()
    {
        Schema::create('payment', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->timestamps();
            $table->integer('user_id')->index('user_id-payment_index');
            $table->foreign('user_id')->references('id')->on('users')->cascadeOnDelete();
            $table->float('amount');
            $table->integer('status')->default(Payments::PAYMENT_CREATED)->index('status-payment-index');
            $table->timestamp('paid_at')->nullable();
            $table->json('card_information')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
//        Schema::drop('payment');
//        Schema::table('payment', function (Blueprint $table) {
//            $table->dropIndex('status-payment-index');
//            $table->dropIndex('user_id-payment_index');
//        });
    }

}
