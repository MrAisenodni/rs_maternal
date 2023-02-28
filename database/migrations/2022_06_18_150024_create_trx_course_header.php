<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTrxCourseHeader extends Migration
{
    public function up()
    {
        Schema::create('trx_course_header', function (Blueprint $table) {
            $table->id();
            $table->string('title')->nullable();
            $table->text('picture')->nullable();
            $table->integer('rating')->nullable();
            $table->text('description')->nullable();
            $table->unsignedInteger('category_id')->nullable(); // Join ke mst_category
            $table->unsignedInteger('level_id')->nullable(); // Join ke mst_level
            
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
        Schema::dropIfExists('trx_course_header');
    }
}
