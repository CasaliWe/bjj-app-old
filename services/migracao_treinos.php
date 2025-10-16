<?php

// importando o autoload do composer
require __DIR__ . '/../vendor/autoload.php';

// lendo das variáveis de ambiente
use Dotenv\Dotenv;
$dotenv = Dotenv::createImmutable(__DIR__ . '/../');
$dotenv->load();

// conectando ao banco de dados OLD
use Illuminate\Database\Capsule\Manager as Capsule;
$capsule = new Capsule;

// Primeira conexão (banco OLD)
$capsule->addConnection([
    'driver'   => 'sqlite',
    'database' => __DIR__ . '/../db/db.sqlite',
    'prefix'   => '',
], 'old_db');

// Segunda conexão (banco NEW - MySQL)
$capsule->addConnection([
    'driver'    => 'mysql',
    'host'      => '',
    'database'  => '',
    'username'  => '',
    'password'  => '',
    'charset'   => 'utf8mb4',
    'collation' => 'utf8mb4_unicode_ci',
    'prefix'    => '',
], 'new_db');

$capsule->setAsGlobal();
$capsule->bootEloquent();

// criando models
use Illuminate\Database\Eloquent\Model;

// Model para o banco OLD
class TreinoOld extends Model {
    protected $connection = 'old_db'; // especifica qual conexão usar
    protected $table = 'treino';
    protected $fillable = ['tipo_treino', 'aula_treino', 'hora_treino', 'dia_treino', 'data_treino', 'img_treino', 'observacoes_treino', 'user_identificador'];
    public $timestamps = true;
    protected $casts = ['observacoes_treino' => 'array', 'img_treino' => 'array'];
}

class TreinoNew extends Model {
    protected $connection = 'new_db';
    protected $table = 'treinos';
    protected $fillable = [
        'usuario_id',
        'numero_aula',
        'tipo',
        'dia_semana',
        'horario',
        'data',
        'observacoes',
        'is_publico'
    ];
    
    public $timestamps = true;
    const CREATED_AT = 'created_at';
    const UPDATED_AT = 'updated_at';
    
    // Relacionamento com imagens (um treino tem muitas imagens)
    public function imagens() {
        return $this->hasMany(TreinoImagem::class, 'treino_id');
    }
}

class TreinoImagem extends Model {
    protected $connection = 'new_db';
    protected $table = 'treinos_imagens';
    protected $fillable = [
        'treino_id',
        'url'
    ];
    
    public $timestamps = true;
    const CREATED_AT = 'created_at';
    const UPDATED_AT = null;
    
    // Relacionamento com treino (uma imagem pertence a um treino)
    public function treino() {
        return $this->belongsTo(TreinoNew::class, 'treino_id');
    }
}


// buscando dados do banco OLD
$treinosOld = TreinoOld::all();

// buscando dados do banco NEW
$treinosNew = TreinoNew::with('imagens')->get();

// exibindo dados
// echo "Dados do banco OLD:\n";
// echo json_encode($treinosOld->first());
echo "\n\nDados do banco NEW:\n";
echo json_encode($treinosNew->first());