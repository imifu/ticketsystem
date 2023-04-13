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
        Schema::create('payment_datas', function (Blueprint $table) {
            $table->id();

            $table->unsignedBigInteger('ticket_id');
            $table->foreign('ticket_id')->references('id')->on('tickets')->onUpdate('RESTRICT')->onDelete('RESTRICT');

            $table->unsignedBigInteger('ticket_detail_id');
            $table->foreign('ticket_detail_id')->references('id')->on('ticket_details')->onUpdate('RESTRICT')->onDelete('RESTRICT');

            $table->unsignedBigInteger('user_ticket_id');
            $table->foreign('user_ticket_id')->references('id')->on('user_tickets')->onUpdate('RESTRICT')->onDelete('RESTRICT');

            $table->timestamp('payment_date');

            $table->integer('amount');

            $table->timestamps();

            $table->integer('del_flg')->length(1)->default(0);
            
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('payment_datas');
    }
};
