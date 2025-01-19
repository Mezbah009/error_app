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
        Schema::create('error_trackings', function (Blueprint $table) {
            $table->id();
            // Foreign key for 'users' table (developer_id)
            $table->foreignId('developer_id')->constrained('users')->onDelete('cascade');

            // Foreign key for 'projects' table (project_id)
            $table->foreignId('project_id')->constrained('projects')->onDelete('cascade');

            $table->date('date'); // Error tracking date
            $table->string('error_type'); // Type of error (e.g., Bug, Issue)
            $table->text('solution_description'); // Solution description
            $table->string('solution_provided_by'); // Name or identifier of the person who provided the solution
            $table->string('status'); // Status of the error (e.g., Pending, Resolved)
            $table->text('comments')->nullable(); // Additional comments
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('error_trackings');
    }
};
