<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Laravel\Sanctum\HasApiTokens;

class Usuario extends Model
{
    use HasApiTokens, HasFactory;

    protected $table = 'usuarios';
    protected $primaryKey = 'id_usuario';
    public $timestamps = false;

    protected $fillable = [
        'email',
        'nome',
        'senha',
        'telefone',
        'endereco',
        'id_tipo_sanguineo',
        'alergias',
        'tipo_usuario',
        'doar',
        'receber'
    ];

    protected $hidden = ['senha'];

    public function tipoSanguineo()
    {
        return $this->belongsTo(TipoSanguineo::class, 'id_tipo_sanguineo', 'id_tipo');
    }

    public function doacoesFeitas()
    {
        return $this->hasMany(Doacao::class, 'id_doador', 'id_usuario');
    }

    public function doacoesRecebidas()
    {
        return $this->hasMany(Doacao::class, 'id_recebedor', 'id_usuario');
    }
}
