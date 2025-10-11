<?php

namespace Models;

use Illuminate\Database\Eloquent\Model;

class Categoria extends Model {
    protected $table = 'categorias';
    protected $fillable = ['nome', 'user_identificador', 'treino_id'];
    public $timestamps = true;

    public function treinos()
    {
        return $this->belongsTo(Treino::class, 'treino_id');
    }

    public function users()
    {
        return $this->belongsTo(User::class, 'id_login');
    }

    public function posicoes()
    {
        return $this->hasMany(Posicao::class, 'categoria_id', 'id');
    }
}