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
        Schema::create('table_supplier', function (Blueprint $table) {
            $table->id();
            $table->string("kode_supplier");
            $table->string("nama_supplier");
            $table->string("notelp_supplier");
            $table->string("alamat_supplier");
            $table->string("email_supplier");
            $table->string("PPN_supplier");
            $table->string("NPWP_supplier");
            $table->string("PPH23_supplier");
            $table->string("CP_supplier");
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('table_supplier');
    }
};
