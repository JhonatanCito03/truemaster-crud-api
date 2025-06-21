<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Metadpto;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class metadptoController extends Controller
{
    public function index()
    {
        $metadpto = Metadpto::all();

        if(!$metadpto){
            $data = [
                'message' => 'Parece que no existen metas de departamento',
                'status' => 404
            ];
            return response()->json($data,404);
        }

        $data = [
            'message' => 'lista de metas de dpto encontradas:',
            'data' => $metadpto,
            'status' => 200
        ];
        return response() -> json($data,200);
    }

    public function store(Request $request)
    {
        $metadpto = Metadpto::all();

        $validator = Validator::make($request -> all(),[
            'valor_meta' => 'required',
            'fecha_inicio' => 'required'
        ]);

        if($validator -> fails()){
            $data = [
                'message' => 'No se han podido registrar los datos:',
                'errors' => $validator -> errors(),
                'status' => 404
            ];
            return response()->json($data,404);
        }

        $metadpto = Metadpto::create([
            'valor_meta' => $request->valor_meta,
            'fecha_inicio' => $request -> fecha_inicio
        ]);
        
        if(!$metadpto){
            $data = [
                'message' => 'No se ha podido crear una nueva instancia de meta dpto',
                'status' => 404     
            ];
            return response() -> json($data,404);
        }

        $data = [
            'message' => 'meta de dpto creada correctamente',
            'data' => $metadpto,
            'status' => 200
        ];
        return response() -> json($data,200);
    }

    public function show($id)
    {
        $metadpto = Metadpto::find($id);

        if(!$metadpto){
            $data = [
                'message' => 'Id no encontrada',
                'status' => 404
            ];
            return response() -> json($data,404);
        }

        $data = [
            'message' => 'Meta encontrada: ',
            'data' => $metadpto,
            'status' => 200
        ];
        return response() -> json($data,200);
    }

    public function update(Request $request,$id)
    {
        $metadpto = Metadpto::find($id);

        if(!$metadpto){
            $data = [
                'message' => 'Meta no encontrada',
                'status' => 404
            ];
            return response() -> json($data,404);
        }

        $validator = Validator::make($request -> all(),[
            'valor_meta' => 'required',
            'fecha_inicio' => 'required'
        ]);

        if($validator -> fails()){
            $data = [
                'message' => 'Error en la validacion de los datos',
                'errors' => $validator->errors(),
                'status' => 404
            ];
            return response()->json($data,404);
        }

        $metadpto->valor_meta = $request->valor_meta;
        $metadpto->fecha_inicio = $request->fecha_inicio;

        $metadpto->save();

        $data = [
            'message' => 'Datos actualizados correctamente: ',
            'data' => $metadpto,
            'status' => 200
        ];
        return response()->json($data,200);

    }
    public function updatePartial(Request $request,$id)
    {
        $metadpto = Metadpto::find($id);

        if(!$metadpto){
            $data = [
                'message' => 'Meta no encontrada',
                'status' => 404
            ];
            return response() -> json($data,404);
        }

        $validator = Validator::make($request -> all(),[
            'valor_meta',
            'fecha_inicio'
        ]);

        if($validator -> fails()){
            $data = [
                'message' => 'Error en la validacion de los datos',
                'errors' => $validator->errors(),
                'status' => 404
            ];
            return response()->json($data,404);
        }

        if($request->has('valor_meta')){
            $metadpto->valor_meta = $request->valor_meta;
        }
        if($request->has('fecha_inicio')){
            $metadpto->fecha_inicio = $request->fecha_inicio;
        }

        $metadpto->save();

        $data = [
            'message' => 'Datos actualizados correctamente: ',
            'data' => $metadpto,
            'status' => 200
        ];
        return response()->json($data,200);
    }
    public function delete($id){
        $metadpto = Metadpto::find($id);

        if(!$metadpto){
            $data = [
                'message' => 'Id no encontrado',
                'status' => 404
            ];
            return response() -> json($data,404);
        }

        $metadpto -> delete();

        $data = [
            'message' => 'Meta de dpto eliminada correctamente',
            'status' => 200
        ];
        return response() -> json($data,200);
    }
}
