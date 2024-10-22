<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Universidad extends Model
{
    use HasFactory;
    protected $fillable=['nombreuniversidad','departamento'];

    public function facultades(){
        return $this->hasMany(
            Facultad::class,
            'idUniversidad',
            'id'
        );
    }
}
