<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateBasicConfigTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('basic_config', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->integer('tax_rate')->default(21);
            $table->integer('tax_flag')->default(0);
            $table->integer('global_discount')->default(0);
            $table->enum('global_discount_type', ['percentage', 'fixed'])->default('percentage');
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
        Schema::dropIfExists('basic_config');
    }
}
