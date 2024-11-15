<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Auth;
use App\Models\Universidad;
use App\Models\Facultad;
use App\Models\Carrera;


class UserProfileController extends Controller
{
    /**
     * Display a listing of the resource.
     */

    public function index()
    {
        $datos_personales = Auth::user();
        $universidades = Universidad::all();
         
        // Solo las universidades se cargan de inicio
        return view('perfil.usuario', compact('datos_personales', 'universidades'));
    }
     
     public function getFacultades($universidad_id)
    {
        $facultades = Facultad::where('idUniversidad', $universidad_id)->get();
        return response()->json($facultades);
    }

    public function getCarreras($facultad_id)
    {
        $carreras = Carrera::where('idFacultad', $facultad_id)->get();
        return response()->json($carreras);
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

    public function updateAcademic(Request $request, string $id)
    {
        $request->validate(
            [
                'universidad'=>'required',
                'facultad'=>'required',
                'carrera'=>'required',
                'fecha_titulo'=>'required|date',
                //'postgrados'=>'required',
            ]
        );
        try {
            if ($request->hasFile('imagenusuario')) {
                $archivo = $request->file('imagenusuario');
                $nombreArchivo = time() . '_' . $archivo->getClientOriginalName();
                $ruta = $archivo->storeAs('fotoperfil', $nombreArchivo, 'public');

                Storage::delete('public/'.Auth::user()->img_titulo);

                $usuario=User::find($id);
                $usuario->img_titulo=$ruta;
                $usuario->universidad=$request->universidad;
                $usuario->facultad=$request->facultad;
                $usuario->carrera=$request->carrera;
                $usuario->fecha_titulo=$request->fecha_titulo;
                $usuario->postgrados=$request->postgrados;
                $usuario->save();

                return response()->json([
                    'mensaje' => 'Guardado',
                ]);
                
            }
            else{
                $usuario=User::find($id);
                $usuario->universidad=$request->universidad;
                $usuario->facultad=$request->facultad;
                $usuario->carrera=$request->carrera;
                $usuario->fecha_titulo=$request->fecha_titulo;
                $usuario->postgrados=$request->postgrados;
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

    public function updateLab(Request $request, string $id)
    {
        $request->validate(
            [
                'trabajo_actual'=>'required',
                'periodo_trabajo'=>'required',
                'dep_trabajo'=>'required',
                'cargo_desempeno'=>'required',
                //'postgrados'=>'required',
            ]
        );
        try {
            if ($request->hasFile('imagenusuario')) {
                $archivo = $request->file('imagenusuario');
                $nombreArchivo = time() . '_' . $archivo->getClientOriginalName();
                $ruta = $archivo->storeAs('fotoperfil', $nombreArchivo, 'public');

                Storage::delete('public/'.Auth::user()->img_titulo);

                $usuario=User::find($id);
                $usuario->trabajo_actual=$request->trabajo_actual;
                $usuario->periodo_trabajo=$request->periodo_trabajo;
                $usuario->dep_trabajo=$request->dep_trabajo;
                $usuario->cargo_desempeno=$request->cargo_desempeno;
                $usuario->save();

                return response()->json([
                    'mensaje' => 'Guardado',
                ]);
                
            }
            else{
                $usuario=User::find($id);
                $usuario->trabajo_actual=$request->trabajo_actual;
                $usuario->periodo_trabajo=$request->periodo_trabajo;
                $usuario->dep_trabajo=$request->dep_trabajo;
                $usuario->cargo_desempeno=$request->cargo_desempeno;
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
    public function changePassword(Request $request, string $id)
    {
        $request->validate([
            'current_password' => 'required',
            'new_password' => 'required|min:8|confirmed', // Confirmación de contraseña
        ]);
    
        try {
            // Verifica que el usuario exista
            $usuario = User::find($id);
    
            if (!$usuario) {
                return response()->json([
                    'message' => 'Usuario no encontrado',
                ], 404);
            }
    
            // Verifica que la contraseña actual sea correcta
            if (!Hash::check($request->current_password, $usuario->password)) {
                return response()->json([
                    'message' => 'La contraseña actual es incorrecta.',
                ], 400);
            }
    
            // Actualiza la contraseña
            $usuario->update([
                'password' => bcrypt($request->new_password), // Usando bcrypt para cifrar la nueva contraseña
            ]);
    
            return response()->json([
                'message' => 'Contraseña cambiada exitosamente.',
            ]);
    
        } catch (\Exception $e) {
            // Manejo de errores
            return response()->json([
                'message' => 'Hubo un error al cambiar la contraseña',
                'error' => $e->getMessage(),
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
