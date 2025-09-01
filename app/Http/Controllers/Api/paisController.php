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
       // $pais = Pais::all();

        $validator = Validator::make($request -> all(),[
            'nombre_pais' => 'required|max:150',
            'codigo_iso' => 'required|unique:pais',
            'prefijo_telefonico' => 'required|unique:pais',
            'moneda' => 'required',
            'idioma_principal' => 'required',
            'activo' => 'required'
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
            'codigo_iso' => $request -> codigo_iso,
            'prefijo_telefonico' => $request -> prefijo_telefonico,
            'moneda' => $request -> moneda,
            'idioma_principal' => $request -> idioma_principal,
            'activo' => $request -> activo
        ]);

        if(!$pais){
            $data = [
                'message' => 'Error al crear el pais',
                'errors' => $pais->getErrors(),
                'status' => 404
            ];
            return response() -> json($data,500);
        }

        $data = [
            'data' => $pais,
            'status' => 200
        ];
        return response() ->json($data, 200);
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
            'codigo_iso' => 'required|unique:pais',
            'prefijo_telefonico' => 'required|unique:pais',
            'moneda' => 'required',
            'idioma_principal' => 'required',
            'activo' => 'required'
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
        $pais -> codigo_iso = $request -> codigo_iso;
        $pais -> prefijo_telefonico = $request -> prefijo_telefonico;
        $pais -> moneda = $request -> moneda;
        $pais -> idioma_principal = $request -> idioma_principal;
        $pais -> activo = $request -> activo;
        $pais -> save();

        $data = [
            'message' => 'Pais actualizado',
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
            'codigo_iso' => 'unique:pais',
            'prefijo_telefonico' => 'unique:pais',
            'moneda',
            'idioma_principal',
            'activo'
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

        if($request -> has('codigo_iso')){
            $pais -> codigo_iso = $request -> codigo_iso;
        }
        if($request -> has('prefijo_telefonico')){
            $pais -> prefijo_telefonico = $request -> prefijo_telefonico;
        }
        if($request -> has('moneda')){
            $pais -> moneda = $request -> moneda;
        }
        if($request -> has('idioma_principal')){
            $pais -> idioma_principal = $request -> idioma_principal;
        }
        if($request -> has('activo')){
            $pais -> activo = $request -> activo;
        }


        $pais -> save();

        $data = [
            'message' => 'Pais actaulizado P',
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
