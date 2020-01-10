<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateGovernTranslationsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('govern_translations', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('govern_id')->unsigned();
            $table->string('name');
            $table->string('locale')->index();

            $table->unique(['govern_id', 'locale']);
            $table->foreign('govern_id')->references('id')->on('governs')->onDelete('cascade');
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
        Schema::dropIfExists('govern_translations');
    }
}
