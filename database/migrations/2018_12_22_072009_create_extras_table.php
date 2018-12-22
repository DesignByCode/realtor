<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;


class CreateExtrasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('extras', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('property_id');
            $table->integer('balcony')->default(0);
            $table->integer('entrance_hall')->default(0);
            $table->integer('family_room')->default(0);
            $table->integer('flatlet')->default(0);
            $table->integer('garden_cottage')->default(0);
            $table->integer('guest_toilet')->default(0);
            $table->integer('kitchen')->default(0);
            $table->integer('laundry')->default(0);
            $table->integer('pantry')->default(0);
            $table->integer('scullery')->default(0);
            $table->integer('staff_quarters')->default(0);
            $table->integer('study')->default(0);

            $table->integer('access_gate')->default(0);
            $table->integer('alarm')->default(0);
            $table->integer('electric_fencing')->default(0);
            $table->integer('fence')->default(0);
            $table->integer('intercom')->default(0);
            $table->integer('security_post')->default(0);

            $table->integer('clubhouse')->default(0);
            $table->integer('golf')->default(0);
            $table->integer('gym')->default(0);
            $table->integer('handicap')->default(0);
            $table->integer('sp_bath')->default(0);
            $table->integer('pet_friendly')->default(0);
            $table->integer('squash_court')->default(0);
            $table->integer('tennis_court')->default(0);

            $table->integer('aircon')->default(0);
            $table->integer('borehole')->default(0);
            $table->integer('built_in_braai')->default(0);
            $table->integer('built_in_cupboards')->default(0);
            $table->integer('deck')->default(0);
            $table->integer('fireplace')->default(0);
            $table->integer('furnished')->default(0);
            $table->integer('garden')->default(0);
            $table->integer('irrigation_system')->default(0);
            $table->integer('lapa')->default(0);
            $table->integer('patio')->default(0);
            $table->integer('pool')->default(0);
            $table->integer('satelite')->default(0);
            $table->integer('scenic_view')->default(0);
            $table->integer('sea_view')->default(0);
            $table->integer('tv')->default(0);
            $table->integer('walk_in_closet')->default(0);

            $table->timestamps();
//            $table->foreign('property_id')->references('id')->on('properties');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('extras');
    }
}
