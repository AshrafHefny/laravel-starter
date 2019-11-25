<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('users', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('type')->index(); // required
            $table->string('first_name')->nullable();
            $table->string('last_name')->nullable();
            $table->mediumText('address')->nullable(); //address
            $table->string('email')->nullable()->index();
            $table->timestamp('email_verified_at')->nullable();
            $table->string('mobile_number')->index()->nullable(); //required
            $table->string('password')->nullable(); //required
            $table->rememberToken();
            $table->string('confirm_token', 190)->nullable();
            $table->string('last_ip', 190)->nullable();
            $table->timestamp('last_logged_in_at')->nullable();
            $table->boolean('super_admin')->nullable()->default(0)->index();
            $table->boolean('is_admin')->nullable()->default(0)->index();
            $table->boolean('is_active')->nullable()->default(1)->index();
            $table->string('profile_picture', 190)->nullable();
            $table->string('language', 190)->nullable();
            $table->boolean('confirmed')->nullable();
            $table->bigInteger('created_by')->nullable()->index();
            $table->timestamps();
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
        Schema::dropIfExists('users');
    }
}
