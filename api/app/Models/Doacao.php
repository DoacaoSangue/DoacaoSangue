<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Doacao extends Model
{
    use HasFactory;

    protected $table = 'doacoes';
    protected $primaryKey = 'id_doacao';
    public $timestamps = false;

    protected $fillable = ['id_doador', 'id_recebedor', 'id_local', 'data'];

    public function doador()
    {
        return $this->belongsTo(Usuario::class, 'id_doador', 'id_usuario');
    }

    public function recebedor()
    {
        return $this->belongsTo(Usuario::class, 'id_recebedor', 'id_usuario');
    }

    public function local()
    {
        return $this->belongsTo(Local::class, 'id_local', 'id_local');
    }
}

