<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{

    public function up(): void
    {
        Schema::create('service_documents', function (Blueprint $table) {
            $table->id();

            $table->unsignedBigInteger('service_id');
            $table->foreign('service_id')
                  ->references('id')->on('services')
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
        Schema::dropIfExists('service_documents');
    }
};
