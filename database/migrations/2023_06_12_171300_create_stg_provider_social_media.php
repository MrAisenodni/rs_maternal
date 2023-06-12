<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateStgProviderSocialMedia extends Migration
{
    public function up()
    {
        Schema::create('stg_provider_social_media', function (Blueprint $table) {
            $table->id();

            // Part untuk Provider
            $table->unsignedInteger('provider_id')->nullable(); // Join ke Tabel stg_provider
            $table->string('title')->nullable();
            $table->string('icon_1', 50)->nullable();
            $table->string('icon_2', 50)->nullable();
            $table->text('link')->nullable();
            
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
        Schema::dropIfExists('stg_provider_social_media');
    }
}
