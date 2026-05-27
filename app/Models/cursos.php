<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class cursos extends Model
{
    use HasFactory;
    protected $fillable = [
             'nome',
             'duracao',
            'mensalidade',
            'area_conhecimento',
            'qtd_disciplina',
            'qtd_vaga',
            'nivel_academico',
            'depa_id'
    ];
}
