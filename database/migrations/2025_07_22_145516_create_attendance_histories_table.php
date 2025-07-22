<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('attendance_histories', function (Blueprint $table) {
            $table->id();
            $table->string('employee_id', 50);
            $table->foreign('employee_id')->references('employee_id')->on('employees')->onDelete('cascade');
            $table->string('attendance_id', 100);
            $table->foreign('attendance_id')->references('attendance_id')->on('attendances')->onDelete('cascade');
            $table->timestamp('date_attendance');
            $table->tinyInteger('attendance_type')->default(1)->comment('1 for clock in, 2 for clock out');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('attendance_histories');
    }
};