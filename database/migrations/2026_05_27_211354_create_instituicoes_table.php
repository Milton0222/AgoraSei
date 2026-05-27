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
        Schema::create('instituicoes', function (Blueprint $table) {
            $table->id();
            $table->string('descricao');
            $table->enum('tipo',['Privada','Publica']);
            $table->float('custo_licenciatura')->nullable();
            $table->string('provincia',20)->default('Benguela');
            $table->string('localizacao');
            $table->integer('qtd_estudante')->default(0);
            $table->integer('qtd_professor')->default(0);
            $table->enum('modalidade_estudo',['Presêncial','Online','Semi-Presêncial']);
            $table->string('reconhecido');
            $table->text('amibiente_campus')->nullable();
            $table->boolean('estado')->default(1);
            $table->string('instagram')->nullable();
            $table->string('linha_atendimento')->nullable();
            $table->string('whatsap')->nullable();
            $table->string('facebook')->nullable();
            $table->date('inicio_funcao')->nullable();

            $table->unsignedBigInteger('user_id');

            $table->foreign('user_id')->references('id')->on('users');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('instituicoes');
    }
};
