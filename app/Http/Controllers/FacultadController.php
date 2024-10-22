<?php

namespace App\Http\Controllers;

use App\Models\Facultad;
use Illuminate\Http\Request;
use Yajra\DataTables\DataTables;

class FacultadController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        if($request->ajax())
        {
            $data = Facultad::orderBy('idUniversidad');;
            return DataTables::of($data)
                ->addColumn('universidad', function($row){
                    return $row->universidad->nombreuniversidad;
                })
                ->addColumn('departamento',function($row){
                    switch($row->universidad->departamento){
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
                                <button class='button' style='background-color:orange; margin: 0 -25px;' label='Open Modal' data-toggle='modal' data-target='#modalPurple' onclick=\"mostrarModal('$row->id','$row->facultad', '$row->idUniversidad','".$row->universidad->departamento."')\">
                                    <i class='fa fa-edit bell'></i>
                                </button>";
                    $btn .= "
                                <button class='button' style='background-color:#ED213A; color:white; margin: 0 -25px;' onclick=eliminarRegistro('$row->id')>
                                    <i class='fa fa-trash bell'></i>
                                </button>
                            </div>
                            ";
                    return $btn;
                })
                ->rawColumns(['action'])
                ->make(true);
        }
        return view('administrador.facultades.facultades');
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
        $facultad=Facultad::create([
                'facultad' => $request->facultad,
                'idUniversidad' => $request->universidad,
        ]);
        return response()->json($facultad, 200);
    }

    /**
     * Display the specified resource.
     */
    public function show($idUniversidad)
    {
        $facultades=Facultad::where("idUniversidad",$idUniversidad)->get();
        return response()->json($facultades);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Facultad $facultad)
    {

    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $facultad)
    {
        $facultadupdate = Facultad::find($facultad);
        $facultadupdate->update([
            'facultad' => $request->facultad,
            'idUniversidad' => $request->universidad,
        ]);
        return response()->json($request->all(),200);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($facultad)
    {
        $eliminar=Facultad::find($facultad);
        $eliminar->delete();
        return response()->json($eliminar,200);
    }
}
