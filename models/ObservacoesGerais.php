<?php

namespace Models;

use Illuminate\Database\Eloquent\Model;

class ObservacoesGerais extends Model {
    protected $table = 'observacoes_gerais';
    protected $fillable = ['observacao', 'user_id'];
    public $timestamps = true;
}