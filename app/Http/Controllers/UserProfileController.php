<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Auth;

class UserProfileController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $datos_personales=Auth::user();
        return view('perfil.usuario',compact('datos_personales'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {

    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
       
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
                'fecha_nacimiento'=>'required|date',
                'lugar_nacimiento'=>'required',
                'nacionalidad'=>'required',
            ]
        );
        try {
            if ($request->hasFile('imagenusuario')) {
                $archivo = $request->file('imagenusuario');
                $nombreArchivo = time() . '_' . $archivo->getClientOriginalName();
                $ruta = $archivo->storeAs('fotoperfil', $nombreArchivo, 'public');

                Storage::delete('public/'.Auth::user()->image_user);

                $usuario=User::find($id);
                $usuario->image_user=$ruta;
                $usuario->sexo=$request->sexo;
                $usuario->celular=$request->celular;
                $usuario->email=$request->email;
                $usuario->latitud=$request->latitud;
                $usuario->longitud=$request->longitud;
                $usuario->domicilio=$request->domicilio;
                $usuario->fecha_nacimiento=$request->fecha_nacimiento;
                $usuario->lugar_nacimiento=$request->lugar_nacimiento;
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
                $usuario->fecha_nacimiento=$request->fecha_nacimiento;
                $usuario->lugar_nacimiento=$request->lugar_nacimiento;
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
