<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Oficina;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class oficinaController extends Controller
{
    public function index(){
        $oficina = Oficina::all();

        if($oficina -> isEmpty()){
            $data = [
                'message' => 'No hay datos',
                'status' => 200
            ];
            return response() -> json($data,200);
        }

        if(!$oficina){
            $data = [
                'message' => 'No hay oficinas',
                'status' => 404
            ];
            return response() ->json($data,404);
        }

        $data = [
            'message' => 'Lista de oficinas',
            'data' => $oficina,
            'status' => 200
        ];
        return response() -> json($data,200);
    }

    public function store(Request $request) {
        $oficina = Oficina::all();

        $validator = Validator::make($request -> all(), [
            'nombre_oficina' => 'required|unique:oficina',
            'municipio' => 'required'
        ]);

        if($validator ->fails()){
            $data = [
                'message' => 'Error en la validacion de los datos: ',
                'errors' => $validator -> errors(),
                'status' => 404
            ];
            return response()->json($data,404);
        }

        $oficina = Oficina::create([
            'nombre_oficina' => $request -> nombre_oficina,
            'municipio' => $request -> municipio
        ]);

        if(!$oficina){
            $data = [
                'message' => 'Error al crear los datos',
                'status' => 500
            ];
            return response() -> json($data,500);
        }

        $data = [
            'message' => 'Oficina creada correctamente',
            'oficina' => $oficina,
            'status' => 200
        ];
        return response() -> json($data,200);
    }

    public function show($id){
        $oficina = Oficina::find($id);

        if(!$oficina) {
            $data = [
                'message' => 'Id no encontrado',
                'status' => 404
            ];
            return response() -> json($data,404);
        }

        $data = [
            'message' => 'Oficina encontrada: ',
            'data' => $oficina,
            'status' => 200
        ];
        return response() -> json($data,200);
    }

    public function delete($id){
        $oficina = Oficina::find($id);

        if(!$oficina){
            $data = [
                'message' => 'Oficina no encontrada',
                'status' => 404
            ];
            return response() -> json($data,404);
        }

        $oficina ->  delete();

        $data = [
            'message' => 'Oficina eliminada',
            'status' => 200
        ];
        return response() -> json($data,200);
    }

    public function update(Request $request, $id){
        $oficina = Oficina::find($id);

        if(!$oficina){
            $data = [
                'message' => 'Oficina no encontrada',
                'status' => 404
            ];
            return response()->json($data,404);
        }

        $validator = Validator::make($request -> all(), [
            'nombre_oficina' => 'required',
            'municipio' => 'required'
        ]);

        if($validator -> fails()){
            $data = [
                'message' => 'Error en la validacion de los datos',
                'errors' => $validator -> errors(),
                'status' => 404
            ];
            return response() -> json($data,404);
        }

        $oficina -> nombre_oficina = $request -> nombre_oficina;
        $oficina -> municipio = $request -> municipio;

        $oficina -> save();

        $data = [
            'message' => 'Oficina actualizada correctamente',
            'data' => $oficina,
            'status' => 200
        ];
        return response() -> json($data,200);
    }

    public function updatePartial(Request $request, $id){
        $oficina = Oficina::find($id);

        if(!$oficina){
            $data = [
                'message' => 'Oficina no encontrada',
                'status' => 404
            ];
            return response()->json($data,404);
        }

        $validator = Validator::make($request -> all(), [
            'nombre_oficina',
            'municipio'
        ]);

        if($validator -> fails()){
            $data = [
                'message' => 'Error en la validacion de los datos',
                'errors' => $validator -> errors(),
                'status' => 404
            ];
            return response() -> json($data,404);
        }

        if($request -> has('nombre_oficina')){
            $oficina -> nombre_oficina = $request -> nombre_oficina;
        }
        
        if($request -> has('municipio')){
            $oficina -> municipio = $request -> municipio;
        }
        
        $oficina -> save();

        $data = [
            'message' => 'Oficina actualizada correctamente',
            'data' => $oficina,
            'status' => 200
        ];
        return response() -> json($data,200);
    }
}
