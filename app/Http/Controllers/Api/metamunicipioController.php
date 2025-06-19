<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Metamunicipio;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class metamunicipioController extends Controller
{
    public function index()
    {
        $metamunicipio = Metamunicipio::all();

        if(!$metamunicipio){
            $data = [
                'message' => 'No existe ningun registro de meta',
                'status' => 404
            ];
            return response()->json($data,404);
        }

        $data = [
            'message'=>'Datos cargados correctamente:',
            'data'=>$metamunicipio,
            'status'=>200
        ];
        return response()->json($data,200);
    }

    public function store(Request $request)
    {
        $metamunicipio = Metamunicipio::all();
        $validator = Validator::make($request -> all(), [
        'valor_meta' => 'required',
        'fecha_inicio' => 'required'
        ]);

        if($validator -> fails()){
            $data = [
                'message' => 'Error en la validacion de los datos',
                'errors' => $validator -> errors(),
                'status' => 400
            ];
            return response() -> json($data,400);
        }

        $metamunicipio = Metamunicipio::create([
        'valor_meta' => $request -> valor_meta,
        'fecha_inicio' => $request -> fecha_inicio
        ]);

        if(!$metamunicipio){
            $data = [
                'message' => 'Error al crear la meta',
                'status' => 404
            ];
            return response() -> json($data,404);
        }

        $data = [
            'metas' => $metamunicipio,
            'status' => 200
        ];
        return response() -> json($data,200);
    }

    public function show($id)
    {
        $metamunicipio = Metamunicipio::find($id);

        if(!$metamunicipio){
            $data = [
                'message' => 'Id no encontrado',
                'meta' => $metamunicipio,
                'status' => 404
            ];
            return response()->json($data,404);
        }

        $data = [
            'message' => 'Meta encontrada',
            'valor_meta' => $metamunicipio,
            'status' => 200
        ];
        return response()->json($data,200);
    }
    
    public function update(Request $request, $id)
    {
        $metamunicipio = Metamunicipio::find($id);

        if(!$metamunicipio){
            $data = [
                'message' => 'Id no encontrado',
                'status' => 404
            ];
            return response() -> json($data,404);
        }

        $validator = Validator::make($request -> all(), [
            'valor_meta' => 'required',
            'fecha_inicio' => 'required'
        ]);

        if($validator -> fails()){
            $data = [
                'message' => 'error al validar los datos',
                'status' => 404
            ];
            return response()->json($data,404);
        }

        $metamunicipio -> valor_meta = $request->valor_meta;
        $metamunicipio -> fecha_inicio = $request->fecha_inicio;

        $metamunicipio->save();

        $data = [
            'Message' => 'Actualizado con exito',
            'Nuevo Valor:' => $metamunicipio,
            'status' => 200
        ];
        return response()->json($data,200);

    }

    public function delete($id){
        $metamunicipio = Metamunicipio::find($id);

        if(!$metamunicipio){
            $data = [
                'message' => 'Meta no encontrada',
                'status' => 404
            ];
            return response() -> json($data,404);
        }

        $metamunicipio -> delete();

        $data = [
            'message' => 'Meta eliminada',
            'status' => 200
        ];
        return response() -> json($data,200);
    }

    public function updatePartial(Request $request, $id)
    {
        $metamunicipio = Metamunicipio::find($id);

        
        $before = $metamunicipio;

        if(!$metamunicipio){
            $data = [
                'message' => 'Meta no encontrada',
                'status' => 404
            ];
            return response()->json($data,404);
        }


        $validator = Validator::make($request -> all(), [
            'valor_meta',
            'fecha_inicio'
        ]);

        if($validator->fails()){
            $data=[
                'message' => 'Error en la validacion de los datos',
                'status' => 404
            ];
            return response()->json($data,404);
        }

        if($request -> has('valor_meta')){
            $metamunicipio -> valor_meta = $request->valor_meta;
        }
        if($request -> has('fecha_inicio')){
            $metamunicipio -> fecha_inicio = $request->fecha_inicio;
        }

        $metamunicipio->save();

        $data =[
            'message' => 'Meta actualizada',
            'Despues' => $metamunicipio,
            'status' => 200
        ];
        return response() -> json($data,200);
    }
}
