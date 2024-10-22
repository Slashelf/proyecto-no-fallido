<?php

namespace App\Http\Controllers;

use App\Models\Universidad;
use Illuminate\Http\Request;
use Yajra\DataTables\DataTables;

class UniversidadController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        if($request->ajax())
        {
            $data = Universidad::orderBy('departamento');
            return DataTables::of($data)
                ->editColumn('departamento',function($row){
                    switch($row->departamento){
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
                                <button class='button' style='background-color:orange; margin: 0 -25px;' label='Open Modal' data-toggle='modal' data-target='#modalPurple' onclick=\"mostrarModal('$row->id', '$row->nombreuniversidad','$row->departamento')\">
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
        return view('administrador.universidades.universidades');
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
        Universidad::create([
            "nombreuniversidad"=>$request->universidad,
            "departamento"=>$request->departamento
        ]);
        return response()->json($request->all(),200);
    }

    /**
     * Display the specified resource.
     */
    public function show($universidad)
    {
        $universidades=Universidad::where("departamento",$universidad)->get();
        return response()->json($universidades);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Universidad $universidad)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $universidad)
    {
        $universidadupdate = Universidad::find($universidad);
        $universidadupdate->update([
            "nombreuniversidad"=>$request->universidad,
            "departamento"=>$request->departamento
        ]);
        return response()->json($request->all(),200);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($universidad)
    {
        $eliminar=Universidad::find($universidad);
        $eliminar->delete();
        return response()->json($eliminar,200);
    }
}
