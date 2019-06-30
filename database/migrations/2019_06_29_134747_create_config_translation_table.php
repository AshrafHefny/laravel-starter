<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateConfigTranslationTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('config_translations', function (Blueprint $table) {
            $table->increments('id');
            $table->string('label')->nullable();
            $table->mediumtext('value')->nullable();

            $table->string('locale')->index();

            $table->unique(['config_filed_id','locale']);

            $table->bigInteger('config_filed_id')->unsigned();
            $table->foreign('config_filed_id')->references('id')->on('configs')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('config_translations');
    }
}
