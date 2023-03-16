<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTrxCourseDetailDocument extends Migration
{
    public function up()
    {
        Schema::create('trx_course_detail_document', function (Blueprint $table) {
            $table->id();
            $table->unsignedInteger('course_detail_id')->nullable(); // Join ke trx_course_detail
            $table->string('title')->nullable();
            $table->text('description')->nullable();
            $table->text('file')->nullable();
            
            // Struktur Baku
            $table->string('access_code')->nullable();
            $table->boolean('disabled')->default(0);
            $table->string('created_by')->nullable();
            $table->dateTime('created_at')->default(now());
            $table->string('updated_by')->nullable();
            $table->dateTime('updated_at')->nullable();
        });
    }

    public function down()
    {
        Schema::dropIfExists('trx_course_detail_document');
    }
}
