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
        Schema::create('tb_d_receive', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->char('fno_receive', 10);
            $table->char('fno_spo', 7)->nullable();
            $table->decimal('fqa_pos', 8, 2);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tb_d_receive');
    }
};
