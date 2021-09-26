<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMessagesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('messages', function (Blueprint $table) {
            $table->id();
//            $table->foreignId('user_id_sender')->constrained('users')->onDelete('cascade');
//            $table->enum('user_guard_sender',['admin','web']);
//            $table->foreignId('user_id_receiver')->nullable()->constrained('users')->onDelete('SET NULL');
//            $table->enum('user_guard_receiver',['admin','web']);
            $table->morphs('sender');//admin,user
            $table->morphs('receiver');//admin,user
            $table->string('subject');
            $table->text('body')->nullable();
            $table->dateTime('read_at')->nullable();
            $table->smallInteger('lang_id');
            $table->engine = 'InnoDB';
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
        Schema::dropIfExists('messages');
    }
}
