<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Cargo;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class cargoController extends Controller
{
   public function index()
   {

    $cargos = Cargo::all();

    /*if($cargos-> isEmpty()) {
        $data = [
            'message' => 'No se han encontrado cargos',
            'status' => 200
        ];
        return response() -> json($data,200);
    }*/
    
    
    $data = [
        'cargos' => $cargos,
        'status' => 200
    ];

    return response()->json($data,200);
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
        'nombre' => 'required|unique:cargo|max:120',
        'descripcion' => 'required',
        'nivel' => 'required',
        'salario_base' => 'required'
        ]);

        //validacion de los datos
        if ($validator -> fails()) {
        $data = [
            'message' => 'Error en la validacion de los datos',
            'errors' => $validator->errors(),
            'status' => 400
        ];
        return response()->json($data,400);
        }

        //traer datos desde la API
        $cargos = Cargo::create([
        'nombre' => $request -> nombre,
        'descripcion' => $request -> descripcion,
        'nivel' => $request -> nivel,
        'salario_base' => $request -> salario_base
        ]);

        //en el caso de que no haya cargos existentes en el request
        if (!$cargos) {
            $data = [
                'message' => 'Error al crear el cargo',
                'status' => 500
            ];
            return response() -> json($data,500);
        }

        $data = [
            'cargos' => $cargos,
            'status' => 201
        ];

        return response()->json($data, 201);
    }    

    public function show($id)
    {
        $cargo = Cargo::find($id);

        if(!$cargo){
            $data = [
                'message' => 'Cargo no encontrado',
                'status' => 404
            ];
            return response() -> json($data, 404);
        }

        $data = [
            'cargo' => $cargo,
            'status' => 200
        ];
        return response() -> json($data, 200);
    }

    public function destroy($id){

        $cargo = Cargo::find($id);

        if(!$cargo) {
            $data = [
                'message' => 'Cargo no encontrado',
                'status' => 404
            ];
            return response()->json($data, 404);
        }

        $cargo->delete();

        $data = [
            'message' => 'Cargo eliminado',
            'status' => 200
        ];

        return response()->json($data,200);

    }
    public function update(Request $request, $id){

        $cargo = Cargo::find($id);

        if(!$cargo){
            $data =  [
                'message' => 'Cargo no encontrado',
                'status' => 200
            ];
            return response()->json($data, 404);
        }

        $validator = Validator::make($request->all(), [
        'nombre' => 'required|max:80',
        'descripcion' => 'required|max:255',
        'nivel' => 'required|max:80',
        'salario_base' => 'required'
        ]);

        if($validator->fails()){
            $data = [
                'message' => 'Error en la validacion de los datos',
                'errors' => $validator->errors(),
                'status' => 400
            ];
            return response()->json($data,400);
        }

        $cargo->nombre = $request -> nombre;
        $cargo->descripcion = $request -> descripcion;
        $cargo->nivel = $request -> nivel;
        $cargo->salario_base = $request -> salario_base;

        $cargo->save();

        $data = [
            'message' => 'Cargo actualizado',
            'cargo' => $cargo,
            'status' => 200
        ];

        return response() ->json($data, 200);
    }
    public function updatePartial(Request $request, $id)
    {
        $cargo = Cargo::find($id);

        if(!$cargo) {
            $data = [
                'message' => 'Cargo no encontrado',
                'status' => 404
            ];
            return response() -> json($data,404);
        }

        $validator = Validator::make($request->all(), [
        'nombre' => 'max:80',
        'descripcion' => 'max:255',
        'nivel' => 'max:80',
        'salario_base' => ''
        ]);

        if($validator -> fails()) {
            $data = [
                'message' => 'Error en la validacion de los datos',
                'errors' => $validator->errors(),
                'status' => 400
            ];
            return response()->json($data,400);
        } 

        if($request -> has('nombre')) {
            $cargo -> nombre = $request -> nombre;
        }        
        if($request -> has('descripcion')) {
            $cargo -> descripcion = $request -> descripcion;
        }        
        if($request -> has('nivel')) {
            $cargo -> nivel = $request -> nivel;
        }        
        if($request -> has('salario_base')) {
            $cargo -> salario_base = $request -> salario_base;
        }

        $cargo -> save();

        $data = [
            'message' => 'Cargo Actualizado',
            'Cargo' => $cargo,
            'status' => 200
        ];

        return response() -> json($data, 200);
    }
}
