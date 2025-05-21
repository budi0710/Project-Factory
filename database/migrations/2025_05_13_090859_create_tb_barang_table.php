<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
       Schema::create('tb_barang', function (Blueprint $table) {
            $table->bigIncrements('id'); // Primary key dan auto_increment
            $table->char('fk_brg', 5)->unique(); // Kode unik barang
            $table->string('fn_brg', 50)->nullable();
            $table->char('fk_sat', 2);
            $table->char('fk_jenis', 2);
            $table->string('fk_user', 50);
            $table->timestamp('ftgl_upd')->default(DB::raw('CURRENT_TIMESTAMP'));
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tb_barang');
    }
};
