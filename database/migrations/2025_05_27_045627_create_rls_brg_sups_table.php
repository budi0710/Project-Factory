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
        Schema::create('rls_brg_sups', function (Blueprint $table) {
            $table->id();
            $table->string("kode_supplier");
            $table->string('id_otomatis');
            $table->string('kode_rls');
            $table->string("nama_brg_sup");
            $table->string("kode_part");
            $table->decimal("harga_beli");
            $table->string("satuan_beli");
            $table->string('foto');
            $table->timestamps();
        });
    }
    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('rls_brg_sups');
    }
};
