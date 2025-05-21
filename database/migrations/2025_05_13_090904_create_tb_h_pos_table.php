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
        Schema::create('tb_h_pos', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->char('fno_pos', 10);
            $table->dateTime('ftgl_pos');
            $table->char('fk_sup', 3);
            $table->string('fppn', 10)->nullable();
            $table->char('fpph23', 1)->nullable();
            $table->string('fket', 100)->nullable();
            $table->string('fk_user', 100);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tb_h_pos');
    }
};
