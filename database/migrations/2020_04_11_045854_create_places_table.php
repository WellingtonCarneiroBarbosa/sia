<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePlacesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('places', function (Blueprint $table) {
            $table->tinyIncrements('id');
            $table->string('name', 120);
            $table->string('capacity', 6);
            $table->float('size')->nullable()->default(10.5);
            $table->boolean('hasProjector')->default(false);
            $table->string('howManyProjectors', 2)->nullable();
            $table->boolean('hasTranslationBooth')->default(false);
            $table->string('howManyBooths', 2)->nullable();
            $table->boolean('hasSound')->default(false);
            $table->boolean('hasLighting')->default(false);
            $table->boolean('hasWifi')->default(false);
            $table->boolean('hasAccessibility')->default(false);
            $table->boolean('hasFreeParking')->default(false);          
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
        Schema::dropIfExists('places');
    }
}
