<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up()
    {
        Schema::create('services', function (Blueprint $table) {
            $table->id();
            $table->string('student_first_name');
            $table->string('student_middle_name')->nullable();
            $table->string('student_last_name');
            $table->string('phone_primary');
            $table->string('phone_alternate')->nullable();
            $table->string('phone_emergency')->nullable();
            $table->string('parent_name');
            $table->string('parent_phone');
            $table->string('parent_email')->nullable();
            $table->string('student_language');
            $table->string('student_home_language');
            $table->string('parent_language');
            $table->string('case_manager_name');
            $table->string('case_manager_phone');
            $table->string('case_manager_email')->nullable();

            $table->string('school_name');
            $table->text('notes')->nullable();
            $table->enum('services_type', ['DIS Counseling', 'Language & Speech', 'ERMHS Counseling']);
            $table->enum('eld_level', ['1', '2', '3', '4', '5', 'EO', 'RFEP']);
            $table->integer('service_minutes');
            $table->string('frequency'); // Weekly, Monthly
            $table->string('provider');
            $table->enum('eligibility', [
                'Speech or Language Impairment',
                'Intellectual Disability',
                'Other Health Impairment',
                'Specific Learning Disability',
                'Autism',
                'Emotional Disability',
                'Deaf-blindness',
                'Deafness',
                'Hearing Impairment',
                'Multiple Disabilities',
                'Orthopedic Impairment',
                'Traumatic Brain Injury',
                'Visual Impairment'
            ]);
            $table->enum('status', ['Received', 'Assigned']);
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('services');
    }
};
