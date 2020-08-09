<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateGarduInduksTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('gardu_induk', function (Blueprint $table) {
            $table->id();
            $table->tinyInteger('isvalid')->default(1);
            $table->bigInteger('code');
            $table->string('name', 100);
            $table->string('address', 500)->nullable(true);
            $table->decimal('lat', 8,3)->nullable(true);
            $table->decimal('long', 9,3)->nullable(true);
            $table->string('phone', 50)->nullable(true);
            $table->string('area', 50)->nullable(true);
            $table->string('status', 50)->nullable(true);
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
        Schema::dropIfExists('gardu_induks');
    }
}
