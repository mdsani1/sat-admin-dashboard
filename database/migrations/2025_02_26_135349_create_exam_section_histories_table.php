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
        Schema::create('exam_section_histories', function (Blueprint $table) {

            $table->id();
            
            // Unique Identifier
            $table->uuid('uuid')->index();
            $table->unsignedBigInteger('exam_section_id')->index()->comment('References the exam section this history belongs to');
            
            // Foreign Key: Associated Exam
            $table->unsignedBigInteger('exam_id')->index()->comment('References the exam this section belongs to');
            
            // Section Details
            $table->enum('audience', ['High School', 'College', 'Graduation', 'SAT 2'])->nullable();
            $table->enum('section_type', ['Physics', 'Chemistry', 'Biology', 'Math', 'Verbal', 'Quant', 'Mixed'])->nullable();
            $table->string('title')->index()->comment('Title of the section');
            $table->text('description')->nullable()->comment('Detailed description of the section');
            $table->integer('num_of_question')->nullable();
            $table->integer('duration')->unsigned()->nullable()->comment('Duration in minutes for this section');
            $table->integer('section_order')->default(1)->comment('total section 4');
            
            // Tracking Users (On user delete, values are set to null)
            $table->unsignedBigInteger('created_by')->nullable();
            $table->unsignedBigInteger('updated_by')->nullable();
            $table->unsignedBigInteger('deleted_by')->nullable();
            $table->softDeletes();
            $table->string('action', 100)->comment('Action performed on the section history');
            $table->timestamps();
            
            $table->foreign('exam_id')->references('id')->on('exams')->onDelete('cascade');
            $table->foreign('created_by')->references('id')->on('users')->onDelete('set null');
            $table->foreign('updated_by')->references('id')->on('users')->onDelete('set null');
            $table->foreign('deleted_by')->references('id')->on('users')->onDelete('set null');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('exam_section_histories');
    }
};