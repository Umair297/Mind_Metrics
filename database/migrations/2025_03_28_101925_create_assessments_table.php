<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('assessments', function (Blueprint $table) {
            $table->id();
            
            // Student Information
            $table->string('first_name');
            $table->string('middle_name')->nullable();
            $table->string('last_name');

            // Contact Details
            $table->string('primary_phone');
            $table->string('alternate_phone')->nullable();
            $table->string('emergency_phone')->nullable();

            // Parent Details
            $table->string('parent_name');
            $table->string('student_language');
            $table->string('home_language');
            $table->string('parent_language');

            // Case Manager
            $table->string('case_manager_name')->nullable();
            $table->string('case_manager_phone')->nullable();
            $table->string('case_manager_email')->nullable();

            // School Details
            $table->string('school_name');
            $table->text('notes')->nullable();

            // Assessment Details
            $table->enum('assessment_type', ['Initial', 'Triennial', 'Re-Evaluation']);
            $table->enum('eld_level', [1, 2, 3, 4, 5, 'EO', 'RFEO']);
            $table->date('date_consent_received')->nullable();
            $table->date('due_date')->nullable();
            $table->date('anticipated_iep_date')->nullable();
            $table->string('provider')->nullable();

            // Assessment Areas
            $table->json('assessment_areas')->nullable();

            $table->json('eligibility')->nullable(); 
            $table->enum('status', ['Received', 'Assigned', 'In Progress', 'Completed']);
            $table->string('attachments')->nullable();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('assessments');
    }
};
