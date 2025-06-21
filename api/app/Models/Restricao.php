<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Restricao extends Model
{
    use HasFactory;

    protected $table = 'restricoes';
    public $timestamps = false;

    protected $fillable = ['id_tipo_doador', 'id_tipo_recebedor'];
}
