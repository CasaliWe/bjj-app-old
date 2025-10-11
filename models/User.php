<?php

namespace Models;

use Illuminate\Database\Eloquent\Model;

class User extends Model {
    protected $table = 'user';
    protected $fillable = ['login', 'senha', 'token', 'identificador', 'nome', 'sobrenome', 'faixa', 'foto', 'email', 'academia', 'bio', 'cidade'];
    public $timestamps = false;
    
    public function categorias()
    {
        return $this->hasMany(Categoria::class, 'user_identificador', 'idlogin');
    }

    public function treinos()
    {
        return $this->hasMany(Treino::class, 'user_identificador', 'identificador');
    }
}