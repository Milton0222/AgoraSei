<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class instituicoes extends Model
{
    use HasFactory;

    protected $fillable = [
        'descricao',
       'tipo',
        'custo_licenciatura',
        'provincia',
        'localizacao',
        'qtd_estudante',
        'qtd_professor',
        'modalidade_estudo',
        'reconhecido',
        'amibiente_campus',
        'estado',
        'instagram',
        'linha_atendimento',
        'whatsap',
        'facebook',
        'inicio_funcao',
        'user_id',
        'site'
    ];
}
