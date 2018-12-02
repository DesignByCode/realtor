<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePropertiesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('properties', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('reference');
            $table->string('full_address')->nullable();
            $table->integer('number')->nullable();
            $table->string('street_name')->nullable();
            $table->string('town')->nullable();
            $table->string('city')->nullable();
            $table->string('country')->nullable();
            $table->string('province')->nullable();
            $table->integer('post_code')->nullable();
            $table->string('lat')->nullable();
            $table->string('lng')->nullable();

            $table->integer('price')->nullable();
            $table->boolean('solemandate')->default(false);
            $table->boolean('sold')->default(false);
            $table->timestamp('live')->nullable();

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
        Schema::dropIfExists('properties');
    }
}
