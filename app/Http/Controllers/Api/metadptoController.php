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
        'titulo_meta' => 'required|max:100',
        'descripcion_meta' => 'required',
        'valor_objetivo' => 'required',
        'unidad' => 'required',
        'fecha_inicio' => 'required',
        'fecha_fin' => 'required',
        'activo' => 'required',
        'departamento_id' => 'required'
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
            'titulo_meta' => $request->titulo_meta,
            'descripcion_meta' => $request -> descripcion_meta,
            'valor_objetivo' => $request -> valor_objetivo,
            'unidad' => $request -> unidad,
            'fecha_inicio' => $request -> fecha_inicio,
            'fecha_fin' => $request -> fecha_fin,
            'activo' => $request -> activo,
            'departamento_id' => $request -> departamento_id,
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
        'titulo_meta' => 'required|max:100',
        'descripcion_meta' => 'required',
        'valor_objetivo' => 'required',
        'unidad' => 'required',
        'fecha_inicio' => 'required',
        'fecha_fin' => 'required',
        'activo' => 'required',
        'departamento_id' => 'required'
        ]);

        if($validator -> fails()){
            $data = [
                'message' => 'Error en la validacion de los datos',
                'errors' => $validator->errors(),
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
        $metadpto->departamento_id = $request->departamento_id;

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
        'titulo_meta' => 'required|max:100',
        'descripcion_meta' => 'required',
        'valor_objetivo' => 'required',
        'unidad' => 'required',
        'fecha_inicio' => 'required',
        'fecha_fin' => 'required',
        'activo' => 'required',
        'departamento_id' => 'required'
        ]);

        if($validator -> fails()){
            $data = [
                'message' => 'Error en la validacion de los datos',
                'errors' => $validator->errors(),
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
        if($request->has('departamento_id')){
            $metadpto->departamento_id = $request->departamento_id;
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
