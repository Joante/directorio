<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Legislador extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'nombre', 'apellido', 'email', 'telefono', 'direccion', 'pais', 'votos_obtenidos', 'partido_politico', 'mandato_inicio', 'mandato_fin', 'automatico'
    ];

    /**
     * Assign the table's name.
     *
     * @var string
     */
    protected $table = 'legisladores';
}
