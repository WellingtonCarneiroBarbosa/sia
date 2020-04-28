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
            $table->string('name', 120)->unique();
            $table->string('capacity', 6);
            $table->float('size')->nullable()->default(null);
            $table->char('outletVoltage', 1)->nullable()->default(null);
            $table->char('hasProjector', 1)->nullable()->default(null);
            $table->string('howManyProjectors', 2)->nullable()->default(null);
            $table->char('hasTranslationBooth', 1)->nullable()->default(null);
            $table->string('howManyBooths', 2)->nullable()->default(null);
            $table->char('hasSound', 1)->nullable()->default(null);
            $table->char('hasLighting', 1)->nullable()->default(null);
            $table->char('hasWifi', 1)->nullable()->default(null);
            $table->char('hasAccessibility', 1)->nullable()->default(null);
            $table->char('hasFreeParking', 1)->nullable()->default(null);          
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
