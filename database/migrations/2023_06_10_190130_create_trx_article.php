<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTrxArticle extends Migration
{
    public function up()
    {
        Schema::create('trx_article', function (Blueprint $table) {
            $table->id();
            $table->string('title')->nullable();
            $table->string('subtitle')->nullable();
            $table->text('picture')->nullable();
            $table->string('picture_name')->nullable();
            $table->text('description')->nullable();
            $table->text('side_description')->nullable();
            $table->enum('type', ['home', 'content']);
            $table->string('hashtag')->nullable();
            
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
        Schema::dropIfExists('trx_article');
    }
}
