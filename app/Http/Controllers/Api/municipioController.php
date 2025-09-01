<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Municipio;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;

class municipioController extends Controller
{
    public function index() 
    {
        $municipio = Municipio::all();

        if($municipio -> isEmpty()){
            $data = [
                'message' => 'No hay municipios para mostrar',
                'status' => 404
            ];
            return response() -> json($data,404);
        }

        if(!$municipio){
            $data = [
                'message' => 'No existen municipios creados',
                'status' => 404
            ];
            return response() -> json($data,404);
        }

        $data = [
            'message' => 'Lista de municipios',
            'data' => $municipio,
            'status' => 200
        ];
        return response() -> json($data,200);
    }

    public function show($id)
    {
        $municipio = Municipio::find($id);

        if(!$municipio){
            $data = [
                'message' => 'Id no encontrado',
                'status' => 404
            ];
            return response($data,404);
        }

        $data = [
            'message' => 'Municipio encontrado:',
            'data' => $municipio,
            'status' => 200
        ];
        return response() -> json($data,200);
    }

    public function store(Request $request)
    {
        $municipio = Municipio::all();

        if($request -> isEmpty){
            $data = [
                'message' => 'Debe ingresar datos',
                'status' => 404
            ];
            return response() -> json($data,404);
        }

        $validator = Validator::make($request -> all(), [
            'nombre_municipio' => 'required|max:150',
            'codigo_municipio' => 'required|unique:municipio',
            'poblacion' => 'required',
            'es_capital' => 'required',
            'activo' => 'required',
            'region_id' => 'required'
        ]);

        if($validator -> fails()){
            $data = [
                'message' => 'Error en la validacion de los datos',
                'errors' => $validator -> errors(),
                'status' => 404
            ];
            return response() -> json($data,404);
        }

        $municipio = Municipio::create([
            'nombre_municipio' => $request->nombre_municipio,
            'codigo_municipio' => $request->codigo_municipio,
            'poblacion' => $request->poblacion,
            'es_capital' => $request->es_capital,
            'activo' => $request->activo,
            'region_id' => $request->region_id,
        ]);

        if(!$municipio){
            $data = [
                'message' => 'Error al crear el municipio',
                'status' => 404
            ];
            return response() -> json($data,404);
        }

        $data = [
            'message' => 'Municipio creado:',
            'data' => $municipio,
            'status' => 200
        ];
        return response() -> json($data,200);
    }

    public function delete($id)
    {
        $municipio = Municipio::find($id);

        if(!$municipio){
            $data = [
                'message' => 'Id no encontrado',
                'status' => 404
            ];
            return response() -> json($data,404);
        }

        $municipio -> delete();

        $data = [
            'message' => 'Municipio eliminado correctamente',
            'status' => 200
        ];
        return response() -> json($data,200);
    }

    public function update(Request $request,$id)
    {
        $municipio = Municipio::find($id);

        if(!$municipio){
        $data = [
             'message' => 'Id no encontrado',
             'status' => 404
        ];
        return response() -> json($data,404);
        }

        $validator = Validator::make($request -> all(), [
            'nombre_municipio' => 'required|max:150',
            'codigo_municipio' => 'required|unique:municipio',
            'poblacion' => 'required',
            'es_capital' => 'required',
            'activo' => 'required',
            'region_id' => 'required'
        ]);

        if($validator -> fails()){
            $data = [
                'message' => 'Error en la validacion de los datos',
                'errors' => $validator->errors(),
                'status' => 404
            ];
            return response() -> json($data,404);
        }

        $municipio -> nombre_municipio = $request -> nombre_municipio;
        $municipio -> codigo_municipio = $request -> codigo_municipio;
        $municipio -> poblacion = $request -> poblacion;
        $municipio -> es_capital = $request -> es_capital;
        $municipio -> activo = $request -> activo;
        $municipio -> region_id = $request -> region_id;

        $municipio -> save();

        $data = [
            'message' => 'Municipio actualizado correctamente',
            'data' => $municipio,
            'status' => 200
        ];
        return response() -> json($data,200);

    }

    public function updatePartial(Request $request,$id)
    {
        $municipio = Municipio::find($id);

        if(!$municipio){
        $data = [
             'message' => 'Id no encontrado',
             'status' => 404
        ];
        return response() -> json($data,404);
        }

        $validator = Validator::make($request -> all(), [
            'nombre_municipio' => 'max:150',
            'codigo_municipio' => 'unique:municipio',
            'poblacion',
            'es_capital',
            'activo',
            'region_id'
        ]);

        if($validator -> fails()){
            $data = [
                'message' => 'Error en la validacion de los datos',
                'errors' => $validator->errors(),
                'status' => 404
            ];
            return response() -> json($data,404);
        }

        if($request -> has('nombre_municipio')){
            $municipio -> nombre_municipio = $request -> nombre_municipio;
        }
        if($request -> has('codigo_municipio')){
            $municipio -> codigo_municipio = $request -> codigo_municipio;
        }
        if($request -> has('poblacion')){
            $municipio -> poblacion = $request -> poblacion;
        }
        if($request -> has('es_capital')){
            $municipio -> es_capital = $request -> es_capital;
        }
        if($request -> has('activo')){
            $municipio -> activo = $request -> activo;
        }
        if($request -> has('region_id')){
            $municipio -> region_id = $request -> region_id;
        }

        $municipio -> save();

        $data = [
            'message' => 'Municipio actualizado correctamente',
            'data' => $municipio,
            'status' => 200
        ];
        return response() -> json($data,200);
    }
}
