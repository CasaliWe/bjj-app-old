<?php

namespace Models;

use Illuminate\Database\Eloquent\Model;

class Admin extends Model {
    protected $table = 'admin';
    protected $fillable = ['manutencao'];
    public $timestamps = false;
}