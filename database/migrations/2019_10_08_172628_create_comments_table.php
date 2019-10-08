<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCommentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('comments', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->text('comment_text')->nullable();
            $table->bigInteger('product_id')->unsigned();
            $table->integer('rate');
            $table->string('user_name');
            $table->timestamps();
            $table->index('product_id');
            $table->foreign('product_id')->references('id')->on('products')->onDelete( 'cascade');;
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('comments');
    }
}
