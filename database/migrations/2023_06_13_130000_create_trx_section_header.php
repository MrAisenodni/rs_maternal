<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTrxSectionHeader extends Migration
{
    public function up()
    {
        Schema::create('trx_section_header', function (Blueprint $table) {
            $table->id();
            $table->unsignedInteger('menu_id')->nullable(); // Join ke Tabel stg_menu
            $table->string('title')->nullable();
            $table->text('picture_header')->nullable();
            $table->string('picture_header_name')->nullable();
            $table->text('picture')->nullable();
            $table->string('picture_name')->nullable();
            
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
        Schema::dropIfExists('trx_section_header');
    }
}
