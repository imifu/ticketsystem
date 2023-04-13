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
      Schema::create('user_tickets', function (Blueprint $table) {
          $table->id();


          $table->unsignedBigInteger('ticket_id');
          $table->foreign('ticket_id')->references('id')->on('tickets')->onUpdate('RESTRICT')->onDelete('RESTRICT');

          $table->unsignedBigInteger('ticket_detail_id');
          $table->foreign('ticket_detail_id')->references('id')->on('ticket_details')->onUpdate('RESTRICT')->onDelete('RESTRICT');

          $table->unsignedBigInteger('user_id');
          $table->foreign('user_id')->references('id')->on('users')->onUpdate('RESTRICT')->onDelete('RESTRICT');

          $table->string('qr_code', 512);
          $table->integer('amount');

          $table->integer('valid_flg')->length(1)->default(0);

          $table->integer('payment_flg')->length(1)->default(1);

          $table->string('seat', 120);

          $table->integer('come_flg')->length(1)->default(0);

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
        //
    }
};
