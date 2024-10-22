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
        Schema::create('users', function (Blueprint $table) {
            $table->id();
            $table->string('username');
            $table->string('image_user')->nullable()->default('imagenes/postgrado.jpg');
            $table->string('nombres');
            $table->string('apellido_paterno')->nullable();
            $table->string('apellido_materno')->nullable();
            $table->enum('sexo', ['M', 'F'])->nullable();
            $table->string('celular')->nullable();
            $table->string('email')->unique();
            $table->timestamp('email_verified_at')->nullable();
            $table->string('domicilio')->nullable();
            $table->double('latitud')->nullable();
            $table->double('longitud')->nullable();
            $table->date('fecha_nacimiento')->nullable();
            $table->string('lugar_nacimiento')->nullable();
            $table->string('nacionalidad')->nullable();
            $table->string('universidad')->nullable();
            $table->string('facultad')->nullable();
            $table->string('carrera')->nullable();
            $table->string('fecha_titulo')->nullable();
            $table->string('img_titulo')->nullable()->default('imagenes/postgrado.jpg');  
            $table->string('postgrados')->nullable();
            $table->string('trabajo_actual')->nullable();
            $table->string('periodo_trabajo')->nullable();
            $table->string('dep_trabajo')->nullable();
            $table->string('cargo_desempeno')->nullable();
            $table->string('password');
            $table->rememberToken();
            $table->timestamps();
        });

        Schema::create('password_reset_tokens', function (Blueprint $table) {
            $table->string('email')->primary();
            $table->string('token');
            $table->timestamp('created_at')->nullable();
        });

        Schema::create('sessions', function (Blueprint $table) {
            $table->string('id')->primary();
            $table->foreignId('user_id')->nullable()->index();
            $table->string('ip_address', 45)->nullable();
            $table->text('user_agent')->nullable();
            $table->longText('payload');
            $table->integer('last_activity')->index();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('users');
        Schema::dropIfExists('password_reset_tokens');
        Schema::dropIfExists('sessions');
    }
};
