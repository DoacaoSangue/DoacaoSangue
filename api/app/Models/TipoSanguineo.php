<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TipoSanguineo extends Model
{
    use HasFactory;

    protected $table = 'tipos_sanguineos';
    protected $primaryKey = 'id_tipo';
    public $timestamps = false;

    protected $fillable = ['tipo'];

    public function usuarios()
    {
        return $this->hasMany(Usuario::class, 'id_tipo_sanguineo', 'id_tipo');
    }
}
