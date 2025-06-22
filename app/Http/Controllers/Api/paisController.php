<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Pais;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;

class paisController extends Controller
{
    public function index()
    {
        $pais = Pais::all();

        if(!$pais){
        $data = [
            'message' => 'Sin datos',
            'status' => 404
        ];
        return response() -> json($data,404);
        }

        $data = [
            'message' => 'Lista de paises:',
            'data' => $pais,
            'status' => 200
        ];
        return response() -> json($data,200);
    }

    public function show($id)
    {
        $pais = Pais::find($id);

        if(!$pais){
            $data = [
                'message' => 'Pais no encontrado',
                'status' => 404
            ];
            return response() -> json($data,404);
        }

        $data = [
            'message' => 'Pais encontrado:',
            'data' => $pais,
            'status' => 200
        ];
        return response() -> json($data,200);
    }

    public function store(Request $request)
    {
        $pais = Pais::all();

        $validator = Validator::make($request -> all(),[
            'nombre_pais' => 'required|unique:pais,nombre_pais',
            'region' => 'required'
        ]);

        if($validator -> fails()){
            $data = [
                'message' => 'error en la validacion de los datos',
                'data' => $validator -> errors(),
                'status'=>404
            ];
            return response() ->json($data,404);
        }

        $pais = Pais::create([
            'nombre_pais' => $request -> nombre_pais,
            'region' => $request -> region
        ]);

        if(!$pais){
            $data = [
                'message' => 'Error al crear el pais',
                'status' => 404
            ];
            return response() -> json($data,404);
        }

        $data = [
            'message' => 'Pais creado correctamente',
            'data' => $pais,
            'status' => 200
        ];
        return response() ->json($data);
    }

    public function update(Request $request,$id)
    {
        $pais = Pais::find($id);

        if(!$pais){
            $data = [
                'message' => 'Pais no encontrado',
                'status' => 404
            ];
            return response() -> json($data,404);
        }

        $validator = Validator::make($request -> all(),[
            'nombre_pais' => 'required|unique:pais,nombre_pais,' . $id,
            'region' => 'required'
        ]);

        if($validator -> fails()){
            $data = [
                'message' => 'error en la validacion de los datos',
                'errors' => $validator -> errors(),
                'status' => 404
            ];
            return response() -> json($data,404);
        }
        $pais -> nombre_pais = $request -> nombre_pais;
        $pais -> region = $request -> region;
        $pais -> save();

        $data = [
            'message' => 'Pais actaulizado',
            'data' => $pais,
            'status' => 200
        ];
        return response() -> json($data,200);
    }

    public function updatePartial(Request $request,$id)
    {
        $pais = Pais::find($id);

        if(!$pais){
            $data = [
                'message' => 'Pais no encontrado',
                'status' => 404
            ];
            return response() -> json($data,404);
        }

        $validator = Validator::make($request -> all(),[
            'nombre_pais' => 'unique:pais,nombre_pais,' . $id,
            'region'
        ]);

        if($validator -> fails()){
            $data = [
                'message' => 'error en la validacion de los datos',
                'errors' => $validator -> errors(),
                'status' => 404
            ];
            return response() -> json($data,404);
        }

        if($request -> has('nombre_pais')){
            $pais -> nombre_pais = $request -> nombre_pais;
        }

        if($request -> has('region')){
            $pais -> region = $request -> region;
        }


        $pais -> save();

        $data = [
            'message' => 'Pais actaulizado',
            'data' => $pais,
            'status' => 200
        ];
        return response() -> json($data,200);
    }

    public function delete($id)
    {
        $pais = Pais::find($id);

        if(!$pais){
            return response()->json([
                'message' => 'Id no encontrada',
                'data'=>404
            ],404);
        }

        $pais -> delete();

        $data = [
            'message' => 'Pais eliminado',
            'data' => $pais,
            'status' => 200
        ];
        return response()->json($data,200);
    }
}
