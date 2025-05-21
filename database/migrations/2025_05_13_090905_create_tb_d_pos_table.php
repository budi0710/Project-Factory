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
        Schema::create('tb_d_pos', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->char('fk_rls', 3);
            $table->char('fno_pos', 10);
            $table->double('fharga', 15, 2);
            $table->decimal('fqa_pos', 8, 2);
            $table->char('fno_spo', 7)->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tb_d_pos');
    }
};
