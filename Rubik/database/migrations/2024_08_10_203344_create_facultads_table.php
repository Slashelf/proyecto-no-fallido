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
        Schema::create('facultads', function (Blueprint $table) {
            $table->id();
            $table->string('facultad');
            $table->unsignedBigInteger('idUniversidad');
            $table->foreign('idUniversidad')->references('id')->on('universidads');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('facultads');
    }
};
