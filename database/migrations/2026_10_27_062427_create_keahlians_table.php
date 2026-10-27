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
        
            Schema::create('Keahlian_1234', function (Blueprint $table) {
                $table->id();
                $table->unsignedBigInteger('biodata_id');
                $table->string('nama_keahlian', 100);
                $table->string('tingkat', 50)->nullable();
                $table->timestamps();

                $table->foreign('biodata_id')
                    ->references('id')->on('Biodata_1234')
                    ->cascadeOnDelete();
});

    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('keahlians');
    }
};
