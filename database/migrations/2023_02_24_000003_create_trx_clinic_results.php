<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTrxClinicResults extends Migration
{
    public function up()
    {
        Schema::create('trx_clinic_results', function (Blueprint $table) {
            $table->id();
            $table->unsignedInteger('companion_id')->nullable();
            $table->unsignedInteger('hospital_id')->nullable();
            $table->unsignedInteger('result_id')->nullable();
            $table->unsignedInteger('detail_result_id')->nullable();
            $table->string('title')->nullable();
            $table->decimal('value')->nullable();
            
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
        Schema::dropIfExists('trx_clinic_results');
    }
}
