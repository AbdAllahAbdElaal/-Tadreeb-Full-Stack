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
        Schema::create('students', function (Blueprint $table) {
            $table->id();
            $table->String('first_name');
            $table->String('last_name');
            $table->string('email')->unique();
            $table->integer('phone')->unique();
            $table->String('major');

            $table->integer('required_hours');
            $table->integer('completed_hours');
            $table->enum('status', ['active', 'pending', 'completed'])->default('pending');

            $table->foreignId('university_id')->constrained()->onDelete('cascade');
            $table->foreignId('member_id')->constrained()->onDelete('cascade');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('students');
    }
};
