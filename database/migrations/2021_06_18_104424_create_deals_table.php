<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDealsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('deals', function (Blueprint $table) {
            $table->id();
            $table->string('img')->nullable();

            $table->string('title',50);
            $table->string('description',150);
            $table->text('text');

            $table->integer('price')->default(0);

            $table->integer('executor_id')->nullable();
            $table->integer('author_id');
            $table->integer('status_id');

            $table->bigInteger('times')->comment("in seconds");
            $table->timestamp('start_time')->nullable();
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
        Schema::dropIfExists('deals');
    }
}
