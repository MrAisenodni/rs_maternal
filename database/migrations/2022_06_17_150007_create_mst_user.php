<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMstUser extends Migration
{
    public function up()
    {
        Schema::create('mst_user', function (Blueprint $table) {
            $table->id();
            $table->string('nik', 16)->unique();
            $table->string('full_name');
            $table->enum('gender', ['l', 'p']);
            $table->string('birth_place')->nullable();
            $table->date('birth_date')->nullable();
            $table->string('email')->unique()->nullable();
            $table->string('phone_number')->unique()->nullable();
            $table->string('home_number')->unique()->nullable();
            $table->text('address_1')->nullable();
            $table->string('address_2', 3)->nullable();
            $table->string('address_3', 3)->nullable();
            $table->unsignedInteger('religion_id')->nullable(); // Join ke Tabel mst_religion
            $table->enum('role', ['adm', 'pat', 'tec']);

            // Social Media
            $table->text('biography')->nullable();
            $table->string('twitter')->nullable();
            $table->string('facebook')->nullable();
            $table->string('instagram')->nullable();
            $table->string('github')->nullable();
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
        Schema::dropIfExists('mst_user');
    }
}
