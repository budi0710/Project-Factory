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
        Schema::create('rls_brg_cus', function (Blueprint $table) {
            $table->id();
            $table->string("kode_cus");
            $table->string('kode_brj');
            $table->string('kode_rbc');
            $table->string("nama_brg_cus");
            $table->string("kode_part");
            $table->decimal("harga_jual");
            $table->string("satuan_jual");
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('rls_brg_cus');
    }
};
