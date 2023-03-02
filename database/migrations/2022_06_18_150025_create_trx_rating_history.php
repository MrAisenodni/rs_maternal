<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTrxRatingHistory extends Migration
{
    public function up()
    {
        Schema::create('trx_rating_history', function (Blueprint $table) {
            $table->id();
            $table->unsignedInteger('course_header_id')->nullable(); // Join ke trx_course_header
            $table->float('rating', 3, 1)->nullable();
            $table->unsignedInteger('comment_by')->nullable();
            $table->dateTime('comment_at')->nullable();
            $table->string('email')->nullable();
            $table->text('comment')->nullable();
            
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
        Schema::dropIfExists('trx_rating_history');
    }
}
