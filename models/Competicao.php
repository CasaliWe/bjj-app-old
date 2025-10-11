<?php

namespace Models;

use Illuminate\Database\Eloquent\Model;

class Competicao extends Model {
    protected $table = 'competicao';
    protected $fillable = ['imagem', 'cidade', 'colocacao', 'data', 'modalidade', 'numero_lutas', 'numero_vitorias', 'numero_derrotas', 'numero_finalizacoes', 'user_id', 'nome_evento'];
    public $timestamps = true;
}