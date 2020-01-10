<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class Zones extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('zones', function (Blueprint $table) {

        $table->increments('id');
        $table->integer('govern_id')->unsigned();
        $table->softDeletes();
            // $table->userstamps();
            // $table->softUserstamps();

        $table->timestamps();
        $table->foreign('govern_id')->references('id')->on('governs')->onDelete('cascade');

    });

    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('zones');

    }
}
