<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTrxCourseDetailTeacher extends Migration
{
    public function up()
    {
        Schema::create('trx_course_detail_teacher', function (Blueprint $table) {
            $table->id();
            $table->unsignedInteger('teacher_id')->nullable(); // Join ke mst_user dengan status teacher
            $table->unsignedInteger('role_id')->nullable(); // Join ke mst_role
            $table->text('description')->nullable();
            $table->string('twitter')->nullable();
            $table->string('facebook')->nullable();
            $table->string('instagram')->nullable();
            $table->string('github')->nullable();
            $table->text('picture')->nullable();
            
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
        Schema::dropIfExists('trx_course_detail_teacher');
    }
}
