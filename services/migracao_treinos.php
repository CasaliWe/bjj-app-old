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
    'host'      => '77.37.69.27',
    'database'  => 'bjjacademybanco',
    'username'  => 'bjjacademyuser',
    'password'  => 'W1e2s3l4e5i6@',
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


// // buscando dados do banco OLD
// $treinosOld = TreinoOld::where('user_identificador', 'e08cbc3c5c99f919632965758cf384d4')->get();

// // migrar dados do banco OLD para o banco NEW seguindo exatamente o formato do banco NEW, convertendo os dados conforme necessário do bando old para o banco new, sabendo que no banco old as imagens sao salvar na mesma tabela mas no banco new as imagens sao salvas em uma tabela separada com relacionamento de 1 para muitos
// // outro detalhe é que o usuario id sempre será 60
// foreach ($treinosOld as $treinoOld) {
//     // mapeando os campos do banco old para o banco new usando create
//     $treinoNew = TreinoNew::create([
//         'usuario_id' => 60, // Definindo o usuario_id como 60
//         'numero_aula' => (int)$treinoOld->aula_treino,
//         'tipo' => mapearTipoTreino($treinoOld->tipo_treino), // Função para mapear o tipo de treino
//         'dia_semana' => mapearDiaSemana($treinoOld->dia_treino), // Função para mapear o dia da semana
//         'horario' => $treinoOld->hora_treino,
//         'data' => $treinoOld->data_treino,
//         'observacoes' => '',
//         'is_publico' => 0 // Definindo como privado por padrão
//     ]);

//     // migrando imagens associadas
//     if (is_array($treinoOld->img_treino)) {
//         foreach ($treinoOld->img_treino as $img) {
//             TreinoImagem::create([
//                 'treino_id' => $treinoNew->id,
//                 'url' => $img
//             ]);
//         }
//     }
// }

// // Função para mapear o tipo de treino
// function mapearTipoTreino($tipoOld) {
//     $mapa = [
//         'Jiu Jitsu' => 'gi',
//         'No Gi' => 'nogi',
//     ];
//     return $mapa[$tipoOld] ?? 'gi';
// }
// // Função para mapear o dia da semana
// function mapearDiaSemana($diaOld) {
//     $mapa = [
//         'Segunda Feira' => 'segunda',
//         'Terça Feira' => 'terca',
//         'Quarta Feira' => 'quarta',
//         'Quinta Feira' => 'quinta',
//         'Sexta Feira' => 'sexta',
//         'Sábado' => 'sabado',
//         'Domingo' => 'domingo',
//     ];
//     return $mapa[$diaOld] ?? 'segunda';
// }



// // deletando todos os treino onde o usuario_id é 60
// TreinoNew::where('usuario_id', 60)->delete();




$treinos = TreinoNew::where('usuario_id', 60)->get();
echo json_encode($treinos, JSON_PRETTY_PRINT);