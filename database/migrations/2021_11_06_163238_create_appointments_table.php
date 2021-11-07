<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAppointmentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('appointments', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->decimal('latitude', 8, 5);
            $table->decimal('longitude', 8, 5);
            $table->integer('student_count');
            $table->integer('students_applied')->default(0);
            $table->dateTime('start_time');
            $table->dateTime('end_time');
            $table->boolean('certificate_needed');
            $table->decimal('price', 15)->nullable();
            $table->longText('description')->nullable();
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
        Schema::dropIfExists('appointments');
    }
}
