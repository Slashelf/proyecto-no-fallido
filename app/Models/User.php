<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Facades\Storage;
use Spatie\Permission\Traits\HasRoles;


class User extends Authenticatable
{
    use HasRoles;
    use HasFactory, Notifiable;

    protected $fillable = [
        'username',
        'image_user',
        'nombres',
        'apellido_paterno',
        'apellido_materno',
        'sexo',
        'celular',
        'email',
        'domicilio',
        'latitud',
        'longitud',
        'fecha_nacimiento',
        'lugar_nacimiento',
        'nacionalidad',
        'universidad',
        'facultad',
        'carrera',
        'fecha_titulo',
        'img_titulo',
        'postgrados',
        'trabajo_actual',
        'periodo_trabajo',
        'dep_trabajo',
        'cargo_desempeno',
        'password',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
        ];
    }

    public function adminlte_image()
    {
        if(auth()->user()->image_user)
            return Storage::url(auth()->user()->image_user);
        else
            return Storage::url('imagenes/postgrado.jpg');
    }

    public function adminlte_desc()
    {
        return auth()->user()->getRoleNames()->first();
    }

    public function adminlte_profile_url()
    {
        return 'profile/usuario';
    }
}
