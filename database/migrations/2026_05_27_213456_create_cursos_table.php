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
        Schema::create('cursos', function (Blueprint $table) {
            $table->id();
            $table->string('nome');
            $table->integer('duracao')->default(4);
            $table->float('mensalidade');
            $table->text('area_conhecimento');
            $table->integer('qtd_disciplina')->default(0);
            $table->integer('qtd_vaga')->default(0);
            $table->enum('nivel_academico',['Bacharel','Licenciado','Mestrado','Pós Graduação','Doutoramento']);

            $table->unsignedBigInteger('depa_id');
            $table->foreign('depa_id')->references('id')->on('departamentos')->onDelete('cascade');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('cursos');
    }
};
