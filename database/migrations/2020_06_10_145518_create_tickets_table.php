<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTicketsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tickets', function (Blueprint $table) {
            $table->id();
            $table->unsignedTinyInteger('user_id')->nullable();
            $table->foreign('user_id')->references('id')->on('users')->onUpdate('cascade')->onDelete('set null');
            $table->unsignedTinyInteger('demand_id')->nullable();
            $table->foreign('demand_id')->references('id')->on('demands')->onUpdate('cascade')->onDelete('set null');
            $table->unsignedTinyInteger('responsible_id')->nullable();
            $table->foreign('responsible_id')->references('id')->on('users')->onUpdate('cascade')->onDelete('set null');
            $table->text('description');
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
        Schema::dropIfExists('tickets');
    }
}
