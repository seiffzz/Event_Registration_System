<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDelegatesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('delegates', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('email');
            $table->string('gender');
            $table->date('dob');
            $table->string('phone_number');
            $table->string('id_front');
            $table->string('id_back');
//            $table->integer('order_id')->unique();
//            $table->string('payment_method');
//            $table->string('transaction_number');
//            $table->string('transaction_receipt');
            $table->boolean('paid')->default(0);
            $table->text('allergies')->nullable();
            $table->string('lc');
            $table->string('role');
            $table->string('function')->nullable();
            $table->string('event');
            $table->boolean('meals_counter')->default(0);
            $table->boolean('checked_in')->default(0);
            $table->boolean('received_confirmation_mail')->default(0);
            $table->boolean('received_payment_mail')->default(0);
            $table->boolean('deleted')->default(0);
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
        Schema::dropIfExists('delegates');
    }
}
