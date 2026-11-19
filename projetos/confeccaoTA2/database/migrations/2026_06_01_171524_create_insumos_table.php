<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void{
    Schema::create('insumos', function (Blueprint $table){
        $table->id();
        $table->string('nome'); // Ex: Tecido Jeans, Linha Branca
        $table->string('unidade_medida'); // Ex: Metros, Kg, Cone
        $table->decimal('preco_custo', 10, 2)->nullable();
        $table->decimal('estoque', 10, 2)->default(0); // Suporta frações como 15.45 Kg
        $table->timestamps();
    });
}

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('insumos');
    }
};
