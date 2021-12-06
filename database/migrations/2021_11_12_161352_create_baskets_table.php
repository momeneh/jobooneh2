<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateBasketsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('baskets', function (Blueprint $table) {
            $table->id();
            $table->foreignId('products_id')->constrained()->onDelete('restrict');
            $table->foreignId('users_id')->constrained()->onDelete('restrict');
            $table->foreignId('orders_id')->nullable()->constrained()->onDelete('set null');
            $table->integer('count')->default(0);
            $table->unique(['products_id','users_id','orders_id'],'uniqueCheck');
            $table->engine = 'InnoDB';
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('baskets');
    }
}
