<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTrxCourseDetailDocumentApproval extends Migration
{
    public function up()
    {
        Schema::create('trx_course_detail_document_approval', function (Blueprint $table) {
            $table->id();
            $table->unsignedInteger('course_detail_id')->nullable(); // Join ke trx_course_detail
            $table->string('title')->nullable();
            $table->text('description')->nullable();
            $table->text('file')->nullable();
            $table->string('file_name')->nullable();
            
            // Struktur Baku Approval
            $table->unsignedInteger('course_detail_document_id')->nullable();
            $table->enum('action', ['add', 'edit', 'delete']);
            
            // Struktur Baku
            $table->string('access_code')->nullable();
            $table->boolean('disabled')->default(0);
            $table->string('created_by')->nullable();
            $table->dateTime('created_at')->default(now());
            $table->string('updated_by')->nullable();
            $table->dateTime('updated_at')->nullable();
            $table->string('approved_by')->nullable();
            $table->dateTime('approved_at')->nullable();
        });
    }

    public function down()
    {
        Schema::dropIfExists('trx_course_detail_document_approval');
    }
}
