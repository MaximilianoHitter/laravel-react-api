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
        Schema::create('trainer_routines', function (Blueprint $table) {
            $table->id();
            $table->foreignId('id_student')->constrained('students');
            $table->foreignId('id_trainer')->constrained('trainers');
            $table->foreignId('id_student_goal')->constrained('student_goals');
            $table->string('name');
            $table->date('final_date');
            $table->date('initial_date');
            $table->foreignId('id_routine_status')->constrained('statuses');
            $table->integer('id_payment')->nullable();
            $table->decimal('amount', 10, 2, false);
            $table->longtext('description');
            $table->string('color');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('trainer_routines');
    }
};
