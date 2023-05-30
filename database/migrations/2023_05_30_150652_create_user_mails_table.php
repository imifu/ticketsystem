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
        Schema::create('user_mails', function (Blueprint $table) {
            $table->id();


            $table->bigInteger('user_id')->unsigned();
            

            $table->bigInteger('mail_id')->unsigned();

            
            $table->integer('send_flg')->length(1)->default(0);

            $table->timestamps();

            $table->integer('del_flg')->length(1)->default(0);

            
            $table->foreign('user_id')->references('id')->on('users')->onUpdate('RESTRICT')->onDelete('RESTRICT');
            $table->foreign('mail_id')->references('id')->on('mails')->onUpdate('RESTRICT')->onDelete('RESTRICT');

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('user_mails');
    }
};
