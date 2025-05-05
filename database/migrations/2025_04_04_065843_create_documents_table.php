<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('documents', function (Blueprint $table) {
            $table->id();

            // Foreign key to assessments table
            $table->unsignedBigInteger('assessment_id');
            $table->foreign('assessment_id')
                  ->references('id')->on('assessments')
                  ->onDelete('cascade');

            $table->string('title');
            $table->text('description')->nullable();
            $table->string('document')->nullable();
            $table->json('multi_documents')->nullable();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('documents');
    }
};
