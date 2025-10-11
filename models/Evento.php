<?php

namespace Models;

use Illuminate\Database\Eloquent\Model;

class Evento extends Model {
    protected $table = 'eventos';
    protected $fillable = ['imagem', 'titulo', 'codigo', 'local', 'data', 'link', 'estado'];
    public $timestamps = true;
}