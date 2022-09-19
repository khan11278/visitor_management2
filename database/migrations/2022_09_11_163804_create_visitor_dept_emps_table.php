<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateVisitorDeptEmpsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('visitor_dept_emps', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('visitor_date_id');
            $table->foreign('visitor_date_id')->references('id')->on('visitor_dates')->onDelete('cascade');
            $table->string('visitor_department');
            $table->string('visitor_meet_person_name');
            $table->string('visitor_reason_to_meet');
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
        Schema::dropIfExists('visitor_dept_emps');
    }
}
