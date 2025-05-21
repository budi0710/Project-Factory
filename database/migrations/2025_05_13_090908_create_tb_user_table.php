<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('tb_user', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('fk_user', 100)->unique();
            $table->string('fn_user', 50);
            $table->string('fpassword', 50);
            $table->string('fhak_akses', 50)->nullable();
            $table->string('femail', 100)->nullable();
            $table->string('fnotele', 15)->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tb_user');
    }
};
