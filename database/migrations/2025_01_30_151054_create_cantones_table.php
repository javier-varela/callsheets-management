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
        Schema::create('cantones', function (Blueprint $table) {
            $table->id();
            $table->string('nombre');
            $table->foreignId('id_provincia')->constrained('provincias', 'id');
            $table->float('latitud');
            $table->float('longitud');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('cantones');
    }
};
