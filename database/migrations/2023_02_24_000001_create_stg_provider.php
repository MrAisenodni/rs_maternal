<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateStgProvider extends Migration
{
    public function up()
    {
        Schema::create('stg_provider', function (Blueprint $table) {
            $table->id();

            // Part untuk Provider
            $table->string('provider_npwp', 25)->unique()->nullable();
            $table->string('provider_name', 250);
            $table->string('provider_birth_place', 100)->nullable(); // Tempat Didirikan
            $table->date('provider_birth_date')->nullable(); // Tanggal Didirikan
            $table->string('provider_email')->unique()->nullable();
            $table->string('provider_phone_number', 25)->unique()->nullable();
            $table->string('provider_home_number', 25)->unique()->nullable();
            $table->text('provider_address_1')->nullable();
            $table->string('provider_address_2', 3)->nullable();
            $table->string('provider_address_3', 3)->nullable();
            $table->unsignedInteger('provider_district_id')->nullable(); // Join ke Tabel mst_district (Kecamatan)
            $table->string('provider_ward')->nullable(); 
            $table->text('provider_logo')->nullable(); // Field untuk Logo Perusahaan (Favicon)
            $table->text('provider_picture')->nullable(); // Field untuk Logo Perusahaan (Utama)

            // Part untuk Owner
            $table->string('owner_npwp', 25)->unique()->nullable();
            $table->string('owner_nik', 16)->unique()->nullable();
            $table->string('owner_name', 250);
            $table->string('owner_birth_place', 100)->nullable(); // Tempat Didirikan
            $table->date('owner_birth_date')->nullable(); // Tanggal Didirikan
            $table->string('owner_email')->unique()->nullable();
            $table->string('owner_phone_number', 25)->unique()->nullable();
            $table->string('owner_home_number', 25)->unique()->nullable();
            $table->text('owner_address_1')->nullable();
            $table->string('owner_address_2', 3)->nullable();
            $table->string('owner_address_3', 3)->nullable();
            $table->unsignedInteger('owner_district_id')->nullable(); // Join ke Tabel mst_district (Kecamatan)
            $table->string('owner_ward')->nullable(); 
            
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
        Schema::dropIfExists('stg_provider');
    }
}
