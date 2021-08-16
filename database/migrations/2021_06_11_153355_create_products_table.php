<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProductsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('products', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->text('description')->nullable();
            $table->boolean('confirmed')->default(0);
            $table->tinyInteger('sell_status')->nullable();
            $table->decimal('pre_pay',20,0)->nullable();//پیش پرداخت مورد نیاز در صورت سفارشی بودن کالا
            $table->text('duration_of_work')->nullable();//مدت زمان انجام کار در صورت سفارشی بودن کالا
            $table->decimal('price',20,0)->nullable();
            $table->smallInteger('lang_id');
            $table->foreignId('categories_id')->nullable()->constrained()->onDelete('SET NULL');
            $table->foreignId('user_id')->constrained('users')->onDelete('cascade');
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
        Schema::dropIfExists('products');
    }
}
