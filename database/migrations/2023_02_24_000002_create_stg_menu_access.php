<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateStgMenuAccess extends Migration
{
    public function up()
    {
        Schema::create('stg_menu_access', function (Blueprint $table) {
            $table->id();
            $table->enum('role', ['adm', 'pat', 'tec']); // Join ke Tabel mst_user
            $table->unsignedInteger('main_menu_id')->nullable(); // Join ke Tabel stg_main_menu
            $table->unsignedInteger('menu_id')->nullable(); // Join ke Tabel stg_menu
            $table->unsignedInteger('submenu_id')->nullable(); // Join ke Tabel stg_submenu
            // $table->unsignedInteger('group_menu_id'); // Join ke Tabel stg_group_menu
            $table->boolean('add')->default(0);
            $table->boolean('edit')->default(0);
            $table->boolean('delete')->default(0);
            $table->boolean('detail')->default(0);
            $table->boolean('view')->default(0);
            
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
        Schema::dropIfExists('stg_menu_access');
    }
}
