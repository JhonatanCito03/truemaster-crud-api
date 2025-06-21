<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Departamento;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;

class departamentoController extends Controller
{
    public function index()
    {
        $departamento = Departamento::all();

        if($departamento -> isEmpty()){
            $data = [
                'message' => 'No existe ningun departamento',
                'status' => 404
            ];
            return response() -> json($data,404);
        }

        $data = [
            'message' => 'lista de departamentos:',
            'data' => $departamento,
            'status' => 200
        ];
        return response() -> json($data, 200);
    }

    public function show($id)
    {
        $departamento = Departamento::find($id);

        if(!$departamento){
            $data = [
                'message' => 'Id no encontrada',
                'status' => 404
            ];
            return response() -> json($data,404);
        }

        $data = [
            'message' => 'Departamento encontrado',
            'data' => $departamento,
            'status' => 200
        ];
        return response() -> json($data,200);
    }
    public function store(Request $request)
    {
        $departamento = Departamento::all();

        if(!$departamento){
            $data = [
                'message' => 'ha ocurrido un error',
                'status' => 404
            ];
            return response() -> json($data,404);
        }

        $validator = Validator::make($request -> all(),[
            'nombre' => 'required|unique:departamento',
            'region' => 'required'
        ]);

        if($validator -> fails()){
            $data = [
                'message' => 'Error en la validacion de los datos:',
                'errors' => $validator -> errors(),
                'status' => 404
            ];
            return response($data,404);
        }

        $departamento = Departamento::create([
            'nombre' => $request->nombre,
            'region' => $request->region
        ]);

        if(!$departamento){
            $data = [
                'message' => 'Error al crear departamento',
                'status' => 400
            ];
            return response() -> json($data,400);
        }

        $data = [
            'message' => 'Departamento creado correctamente',
            'data' => $departamento,
            'status' => 200
        ];
        return response() -> json($data,200);
    }

    public function delete($id)
    {
        $departamento = Departamento::find($id);

        if(!$departamento){
            $data = [
                'message' => 'Id no encontrado',
                'status' => 404
            ];
            return response() -> json($data,404);
        }

        $departamento -> delete();

        $data = [
            'message' => 'Departamento eliminado con exito',
            'status' => 200
        ];
        return response() -> json($data,200);
    }

    public function update(Request $request,$id)
    {
        $departamento = Departamento::find($id);

        if(!$departamento){
            $data = [
                'message' => 'Id no encontrada',
                'status' => 404
            ];
            return response() -> json($data,404);
        }

        $validator = Validator::make($request -> all(), [
            'nombre' => 'required|unique:departamento',
            'region' => 'required'
        ]);

        if($validator -> fails()){
            $data = [
                'message' => 'Error en la validacion de los datos',
                'errors' => $validator -> errors(),
                'status' => 400
            ];
            return response() -> json($data, 400);
        }

        $departamento -> nombre = $request -> nombre;
        $departamento -> region = $request -> region;

        $departamento -> save();

        $data = [
            'message' => 'departamento actualizado',
            'data' => $departamento,
            'status' => 200
        ];
        return response() -> json($data,200);

    }

    public function updatePartial(Request $request,$id)
    {
        $departamento = Departamento::find($id);

        if(!$departamento){
            $data = [
                'message' => 'Id no encontrada',
                'status' => 404
            ];
            return response() -> json($data,404);
        }

        $validator = Validator::make($request -> all(), [
            'nombre' => 'unique:departamento',
            'region'
        ]);

        if($validator -> fails()){
            $data = [
                'message' => 'Error en la validacion de los datos',
                'errors' => $validator -> errors(),
                'status' => 400
            ];
            return response() -> json($data, 400);
        }

        if($request -> has('nombre')){
            $departamento -> nombre = $request -> nombre;
        }

        if($request -> has('region')){
            $departamento -> region = $request -> region;
        }

        $departamento -> save();

        $data = [
            'message' => 'departamento actualizado -m',
            'data' => $departamento,
            'status' => 200
        ];
        return response() -> json($data,200);
    }
}
