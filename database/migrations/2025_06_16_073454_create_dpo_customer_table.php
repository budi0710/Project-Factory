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
        Schema::create('dpo_customer', function (Blueprint $table) {
            $table->id();
            $table->char('fno_rbc', 3);
            $table->char('fno_poc', 10);
            $table->double('fharga', 15, 2);
            $table->decimal('fqa_poc', 8, 2);
            $table->char('fno_spk', 7)->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('dpo_customer');
    }
};
