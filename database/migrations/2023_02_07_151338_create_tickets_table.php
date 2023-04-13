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
        Schema::create('tickets', function (Blueprint $table) {
            $table->id();

            $table->string('title', 512);
            $table->text('ticket_explain');

            $table->string('image', 256);

            $table->integer('show_flg')->length(1)->default(0);
            $table->integer('sold_out_flg')->length(1)->default(0);

            $table->timestamp('show_from');
            $table->timestamp('show_to')->nullable();

            $table->string('owner_name', 120);
            $table->string('live_name', 256);

            $table->timestamp('open_date');

            $table->timestamp('close_date')->nullable();

            $table->string("place", 512);

            $table->text('access');

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
        Schema::dropIfExists('tickets');
    }
};
