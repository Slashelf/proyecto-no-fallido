<?php

namespace App\Http\Controllers;

use App\Models\Carrera;
use Illuminate\Http\Request;
use Yajra\DataTables\DataTables;

class CarreraController extends Controller
{
    /*public function __construct()
    {
        $this->middleware('can:secretaria.permiso')->only('index','create');
    }*/
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        if($request->ajax())
        {
            $data = Carrera::all();
            return DataTables::of($data)
                ->addColumn('universidad', function($row){
                    return $row->facultades->universidad->nombreuniversidad;
                })
                ->addColumn('facultad', function($row){
                    return $row->facultades->facultad;
                })
                ->addColumn('departamento',function($row){
                    switch($row->facultades->universidad->departamento){
                        case 'LP': return "LA PAZ";
                        case 'SCZ': return "SANTA CRUZ";
                        case 'CBBA': return "COCHABAMBA";
                        case 'OR': return "ORURO";
                        case 'PT': return "POTOSÍ";
                        case 'CH': return "CHUQUISACA";
                        case 'TJA': return "TARIJA";
                        case 'BE': return "BENI";
                        case 'PD': return "PANDO";
                        case 'EX': return "EXTRANJERO";
                    }
                })
                ->addColumn('action',function($row){
                    $btn = "<div class='d-flex justify-content-around align-items-center'>
                                <button class='button' style='background-color:orange; margin: 0 0px;' label='Open Modal' data-toggle='modal' data-target='#modalPurple' onclick=\"mostrarModal('$row->id','$row->nombreCarrera','".$row->facultades->universidad->departamento."','".$row->facultades->id."','".$row->facultades->universidad->id."')\">
                                    <i class='fa fa-edit bell'></i>
                                </button>";
                    $btn .= "
                                <button class='button' style='background-color:#ED213A; color:white; margin: 0 0px;'  onclick=eliminarRegistro('$row->id')>
                                    <i class='fa fa-trash bell'></i>
                                </button>
                            </div>
                            ";
                    return $btn;
                })
                ->rawColumns(['action'])
                ->make(true);
        }
        return view('administrador.carreras.carreras');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $carrera=Carrera::create([
            'nombreCarrera' => $request->carrera,
            'idFacultad' => $request->facultad,
        ]);
        return response()->json($carrera, 200);
    }

    /**
     * Display the specified resource.
     */
    public function show($carrera)
    {
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Carrera $carrera)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $carrera)
    {

        $carreraupdate=Carrera::find($carrera);
        $carreraupdate->update([
            'nombreCarrera' => $request->carrera,
            'idFacultad' => $request->facultad,
        ]);
        return response()->json($carreraupdate, 200);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($carrera)
    {
        $carrera=Carrera::find($carrera);
        $carrera->delete();
        return response()->json($carrera, 200);
    }
}
