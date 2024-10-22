<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class UserProfileController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $datos_personales=auth()->user();
        session()->forget('solicitud');
        return view('perfil.usuario',compact('datos_personales'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $datos_personales=auth()->user();
        session()->flash('solicitud', 'Bienvenido al perfil de usuario.');
        return view('perfil.usuario',compact('datos_personales'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        try {
            // Verificar si se subió una imagen
            if ($request->hasFile('imagenusuario')) {
                // Obtener el archivo
                $archivo = $request->file('imagenusuario');
    
                // Generar un nombre único para evitar conflictos
                $nombreArchivo = time() . '_' . $archivo->getClientOriginalName();
    
                // Guardar la imagen en 'public/imagenes' usando el nombre generado
                $ruta = $archivo->storeAs('fotoperfil', $nombreArchivo, 'public');
    
                // Devolver respuesta JSON con la ruta de acceso pública
                return response()->json([
                    'mensaje' => 'Imagen subida correctamente',
                    'nombre' => $nombreArchivo,
                    'ruta' => Storage::url($ruta), // Devuelve la URL pública de la imagen
                ]);
            }
    
            // Si no se subió ninguna imagen
            return response()->json([
                'mensaje' => 'No se recibió ninguna imagen',
            ], 400);
        } catch (\Exception $e) {
            // Manejo de errores en caso de falla
            return response()->json([
                'mensaje' => 'Hubo un error al subir la imagen',
                'error' => $e->getMessage(),
            ], 500);
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $request->validate(
            [
                'sexo'=>'required',
                'celular'=>'required|numeric',
                'email'=>'required|email|unique:users,email,'.$id,
                'latitud'=>'required|numeric',
                'longitud'=>'required|numeric',
                'domicilio'=>'required',
                'fechanacimiento'=>'required|date',
                'lugarnacimiento'=>'required',
                'nacionalidad'=>'required',
            ]
        );
        try {
            if ($request->hasFile('imagenusuario')) {
                $archivo = $request->file('imagenusuario');
                $nombreArchivo = time() . '_' . $archivo->getClientOriginalName();
                $ruta = $archivo->storeAs('fotoperfil', $nombreArchivo, 'public');

                Storage::delete('public/'.auth()->user()->image_user);

                $usuario=User::find($id);
                $usuario->image_user=$ruta;
                $usuario->sexo=$request->sexo;
                $usuario->celular=$request->celular;
                $usuario->email=$request->email;
                $usuario->latitud=$request->latitud;
                $usuario->longitud=$request->longitud;
                $usuario->domicilio=$request->domicilio;
                $usuario->fecha_nacimiento=$request->fechanacimiento;
                $usuario->lugar_nacimiento=$request->lugarnacimiento;
                $usuario->nacionalidad=$request->nacionalidad;
                $usuario->save();

                return response()->json([
                    'mensaje' => 'Guardado',
                ]);
                
            }
            else{
                $usuario=User::find($id);
                $usuario->sexo=$request->sexo;
                $usuario->celular=$request->celular;
                $usuario->email=$request->email;
                $usuario->latitud=$request->latitud;
                $usuario->longitud=$request->longitud;
                $usuario->domicilio=$request->domicilio;
                $usuario->fecha_nacimiento=$request->fechanacimiento;
                $usuario->lugar_nacimiento=$request->lugarnacimiento;
                $usuario->nacionalidad=$request->nacionalidad;
                $usuario->save();

                return response()->json([
                    'mensaje' => 'Guardado',
                ]);
            }
            return response()->json([
                'mensaje' => 'No se recibió ninguna imagen',
            ], 400);
        } catch (\Exception $e) {
            // Manejo de errores en caso de falla
            return response()->json([
                'mensaje' => 'Hubo un error al subir la imagen',
                'error' => $e,
            ], 500);
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
