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
        'titulo_meta' => 'required|max:100',
        'descripcion_meta' => 'required',
        'valor_objetivo' => 'required',
        'unidad' => 'required',
        'fecha_inicio' => 'required',
        'fecha_fin' => 'required',
        'activo' => 'required',
        'municipio_id' => 'required',
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
            'titulo_meta' => $request->titulo_meta,
            'descripcion_meta' => $request -> descripcion_meta,
            'valor_objetivo' => $request -> valor_objetivo,
            'unidad' => $request -> unidad,
            'fecha_inicio' => $request -> fecha_inicio,
            'fecha_fin' => $request -> fecha_fin,
            'activo' => $request -> activo,
            'departamento_id' => $request -> departamento_id,
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
        'titulo_meta' => 'required|max:100',
        'descripcion_meta' => 'required',
        'valor_objetivo' => 'required',
        'unidad' => 'required',
        'fecha_inicio' => 'required',
        'fecha_fin' => 'required',
        'activo' => 'required',
        'municipio_id' => 'required',
        ]);

        if($validator -> fails()){
            $data = [
                'message' => 'error al validar los datos',
                'status' => 404
            ];
            return response()->json($data,404);
        }

        $metadpto->titulo_meta = $request->titulo_meta;
        $metadpto->descripcion_meta = $request->descripcion_meta;
        $metadpto->valor_objetivo = $request->valor_objetivo;
        $metadpto->unidad = $request->unidad;
        $metadpto->fecha_inicio = $request->fecha_inicio;
        $metadpto->fecha_fin = $request->fecha_fin;
        $metadpto->activo = $request->activo;
        $metadpto->municipio_id = $request->municipio_id;

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

        if(!$metamunicipio){
            $data = [
                'message' => 'Meta no encontrada',
                'status' => 404
            ];
            return response()->json($data,404);
        }


        $validator = Validator::make($request -> all(), [
        'titulo_meta',
        'descripcion_meta',
        'valor_objetivo',
        'unidad',
        'fecha_inicio',
        'fecha_fin',
        'activo',
        'municipio_id'
        ]);

        if($validator->fails()){
            $data=[
                'message' => 'Error en la validacion de los datos',
                'status' => 404
            ];
            return response()->json($data,404);
        }

        if($request->has('titulo_meta')){
            $metadpto->titulo_meta = $request->titulo_meta;
        }
        if($request->has('descripcion_meta')){
            $metadpto->descripcion_meta = $request->descripcion_meta;
        }
        if($request->has('valor_objetivo')){
            $metadpto->valor_objetivo = $request->valor_objetivo;
        }
        if($request->has('unidad')){
            $metadpto->unidad = $request->unidad;
        }
        if($request->has('fecha_inicio')){
            $metadpto->fecha_inicio = $request->fecha_inicio;
        }
        if($request->has('fecha_fin')){
            $metadpto->fecha_fin = $request->fecha_fin;
        }
        if($request->has('activo')){
            $metadpto->activo = $request->activo;
        }
        if($request->has('municipio_id')){
            $metadpto->municipio_id = $request->municipio_id;
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
