<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddFieldsToUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('users', function (Blueprint $table) {
            $table->decimal('mobile_no',15,0)->nullable();
            $table->text('address')->nullable();
            $table->string('job_title') ->nullable();
            $table->string('image') ->nullable();
            $table->text('description') ->nullable();
            $table->string('g_plus_address')->nullable();
            $table->string('insta_address')->nullable();
            $table->string('facebook_address')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('users', function (Blueprint $table) {
            //
        });
    }
}
