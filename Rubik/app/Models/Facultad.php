<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Facultad extends Model
{
    use HasFactory;
    protected $fillable = ['facultad','idUniversidad'];

    public function universidad(){
        return $this->belongsTo(
            Universidad::class,
            'idUniversidad',
            'id'
        );
    }

    public function carreras(){
        return $this->hasMany(
            Carrera::class, 
            'id',
            'idFacultad'
        );
    }
}
