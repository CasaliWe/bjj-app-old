<?php

namespace Models;

use Illuminate\Database\Eloquent\Model;

class Noticia extends Model {
    protected $table = 'noticia';
    protected $fillable = ['titulo', 'descricao', 'url', 'imagem'];
    public $timestamps = true;
}