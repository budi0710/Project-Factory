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
       Schema::create('tb_supplier', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->char('fk_sup', 3)->unique();
            $table->string('fn_sup', 100);
            $table->string('fn_su', 100);
            $table->string('femail', 100);
            $table->string('fnotelp', 100);
            $table->string('falamat', 100);
            $table->string('fcp', 100);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tb_supplier');
    }
};
