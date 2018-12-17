<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;


class CreateFeaturesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('features', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('property_id');
            $table->integer('bedrooms')->default(0);
            $table->integer('bathrooms')->default(0);
            $table->integer('dining_areas')->default(0);
            $table->integer('en_suites')->default(0);
            $table->integer('lounges')->default(0);
            $table->integer('storeys')->default(0);

            $table->integer('floor_area')->default(0);
            $table->integer('land_area')->default(0);

            $table->integer('garages')->default(0);
            $table->integer('covered_parking')->default(0);
            $table->integer('open_parking')->default(0);
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
        Schema::dropIfExists('features');
    }
}
