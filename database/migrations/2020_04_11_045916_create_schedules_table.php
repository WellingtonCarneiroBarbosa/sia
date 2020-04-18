<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSchedulesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('schedules', function (Blueprint $table) {
            $table->id();
            $table->string('title', 40);
            $table->unsignedTinyInteger('place_id')->nullable();
            $table->foreign('place_id')->references('id')->on('places')->onUpdate('set null')->onDelete('set null');
            $table->timestamp('start')->nullable();
            $table->timestamp('end')->nullable();
            $table->foreignId('customer_id')->nullable()->constrained()->onUpdate('set null')->onDelete('set null');
            $table->text('details', 100)->nullable();
            /***
             * Define if the shedule is confirmed or not
             * 
             * null == not
             * 1 == yes
             * 
             */
            $table->string('status')->nullable()->default('1');
            $table->timestamps();
            /***
             * Cancel any schedule
             * 
             */
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
        Schema::dropIfExists('schedules');
    }
}
