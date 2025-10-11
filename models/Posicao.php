<?php

namespace Models;

use Illuminate\Database\Eloquent\Model;

class Posicao extends Model {
    protected $table = 'posicoes';
    protected $fillable = ['nome', 'categoria_id', 'user_identificador'];
    public $timestamps = true;

    public function categorias()
    {
        return $this->belongsTo(Categoria::class, 'categoria_id');
    }

    public function finalizacoes()
    {
        return $this->hasMany(Finalizacao::class, 'posicao_id', 'id');
    }
}