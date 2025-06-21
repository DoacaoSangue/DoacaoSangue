<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Local extends Model
{
    use HasFactory;

    protected $table = 'locais';
    protected $primaryKey = 'id_local';
    public $timestamps = false;

    protected $fillable = ['nome', 'bairro', 'rua', 'numero'];

    public function doacoes()
    {
        return $this->hasMany(Doacao::class, 'id_local', 'id_local');
    }
}
