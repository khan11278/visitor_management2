<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateVisitorDatesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('visitor_dates', function (Blueprint $table) {
            $table->dropForeign('visitor_id');
            $table->dropForeign('visitor_enter_by');
            $table->id();
            $table->unsignedBigInteger('visitor_id');
            $table->foreign('visitor_id')->references('id')->on('visitors')->onDelete('cascade');
            $table->unsignedBigInteger('visitor_enter_by');
            $table->foreign('visitor_enter_by')->references('id')->on('users')->onDelete('cascade');
            $table->datetime('visitor_enter_time');
            $table->datetime('visitor_out_time')->default(null);
            $table->enum('visitor_status', ['In', 'Out']);
            $table->integer('visitor_token');
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
        Schema::dropIfExists('visitor_dates');
    }
}
