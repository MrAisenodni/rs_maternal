<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTrxCountHistory extends Migration
{
    public function up()
    {
        Schema::create('trx_count_history', function (Blueprint $table) {
            $table->id();
            $table->enum('type', ['guest', 'video', 'document']);
            $table->unsignedInteger('foreign_id')->nullable();
            $table->integer('count')->nullable();
            
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
        Schema::dropIfExists('trx_count_history');
    }
}
