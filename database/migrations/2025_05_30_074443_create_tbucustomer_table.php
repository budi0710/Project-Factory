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
        Schema::create('tbucustomer', function (Blueprint $table) {
            $table->id();
            $table->string("kode_cus");
            $table->string("nama_cus");
            $table->string("notelp_cus");
            $table->string("alamat_cus");
            $table->string("email_cus");
            $table->string("PPN_cus");
            $table->string("NPWP_cus");
            $table->string("PPH23_cus");
            $table->string("CP_cus");
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tbucustomer');
    }
};
