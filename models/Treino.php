<?php

namespace Models;

use Illuminate\Database\Eloquent\Model;

class Treino extends Model {
    protected $table = 'treino';
    protected $fillable = ['tipo_treino', 'aula_treino', 'hora_treino', 'dia_treino', 'data_treino', 'img_treino', 'observacoes_treino', 'user_identificador'];
    public $timestamps = true;
    protected $casts = ['observacoes_treino' => 'array', 'img_treino' => 'array'];

    public function categorias()
    {
        return $this->hasMany(Categoria::class, 'treino_id', 'treino_id');
    }

    public function users()
    {
        return $this->belongsTo(User::class, 'user_identificador');
    }
}