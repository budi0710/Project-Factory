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
        Schema::create('tb_h_bayar', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->char('fno_ap', 10);
            $table->char('fk_sup', 3);
            $table->string('fno_FP', 100)->nullable();
            $table->char('fppn', 1)->nullable();
            $table->decimal('fjml_ppn', 15, 2);
            $table->decimal('fjml_bayar', 15, 2);
            $table->char('fpph23', 1)->nullable();
            $table->decimal('fjml_pph23', 15, 2);
            $table->string('fk_user', 100);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tb_h_bayar');
    }
};
