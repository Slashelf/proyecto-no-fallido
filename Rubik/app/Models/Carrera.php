<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Carrera extends Model
{
    use HasFactory;
    protected $fillable = ['nombreCarrera','idFacultad'];

    public function facultades(){
        return $this->belongsTo(
            Facultad::class,
            'idFacultad',
            'id'
        );
    }
}
