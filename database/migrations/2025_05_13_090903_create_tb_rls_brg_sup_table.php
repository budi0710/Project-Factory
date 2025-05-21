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
        Schema::create('tb_rls_brg_sup', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->char('fk_brg', 5);
            $table->char('fk_sup', 3);
            $table->char('fk_rls', 3);
            $table->string('fn_brg_sup', 100)->nullable();
            $table->double('fharga_beli', 15, 2);
            $table->string('fk_user', 100);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tb_rls_brg_sup');
    }
};
