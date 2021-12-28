<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateOrdersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('orders', function (Blueprint $table) {
            $table->id();
            $table->decimal('sum_price_pros',20,0)->default(0);
            $table->decimal('post_price',20,0)->default(0);
            $table->text('deliver_place')->nullable();
            $table->decimal('final_price',20,0)->default(0);
            $table->string('receipt_image')->nullable();
            $table->tinyInteger('owner_confirmed')->default(0);
            $table->string('post_tracking_number')->nullable();
            $table->foreignId('shopper_id')->constrained('users')->onDelete('restrict');
            $table->foreignId('seller_id')->constrained('users')->onDelete('restrict');
            $table->smallInteger('lang_id');
            $table->timestamps();
            $table->engine = 'InnoDB';
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('orders');
    }
}
