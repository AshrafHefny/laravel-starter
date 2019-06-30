<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateConfigsTable extends Migration {

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up() {
        Schema::create('configs', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('field_type')->nullable()->default('text'); // text, textarea, file
            $table->string('field_class')->nullable(); 
            $table->string('type')->nullable()->index();
            $table->string('field')->nullable();
            $table->bigInteger('created_by')->nullable()->index();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down() {
        Schema::dropIfExists('configs');
    }

}
