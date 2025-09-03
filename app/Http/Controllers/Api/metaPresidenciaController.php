<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Meta_presidencia;
use Illuminate\Support\Facades\Validator;

class MetaPresidenciaController extends Controller
{
     public function index(){
        $meta_presidencia = Meta_presidencia::all();

        if($meta_presidencia -> isEmpty()){
            $data = [
                'message' => 'No hay datos',
                'status' => 200
            ];
            return response() -> json($data,200);
        }

        if(!$meta_presidencia){
            $data = [
                'message' => 'No hay metas de presidencia disponibles',
                'status' => 404
            ];
            return response() ->json($data,404);
        }

        $data = [
            'message' => 'Lista de metas de presidencia',
            'data' => $meta_presidencia,
            'status' => 200
        ];
        return response() -> json($data,200);
    }

    public function store(Request $request) {
        $meta_presidencia = Meta_presidencia::all();

        $validator = Validator::make($request -> all(), [
        'nombre_meta' => 'required|max:150',
        'descripcion_meta' => 'required|max:255',
        'valor_objetivo' => 'required|numeric',
        'valor_actual' => 'required|numeric',
        'estado_meta' => 'required|in:activo,inactivo',
        'creado_por' => 'required|exists:users,id',
        'actualizado_por' => 'required|exists:users,id',
        ]);

        if($validator ->fails()){
            $data = [
                'message' => 'Error en la validacion de los datos: ',
                'errors' => $validator -> errors(),
                'status' => 404
            ];
            return response()->json($data,404);
        }

        $meta_presidencia = Meta_presidencia::create([
            'nombre_meta' => $request -> nombre_meta,
            'descripcion_meta' => $request -> descripcion_meta,
            'valor_objetivo' => $request -> valor_objetivo,
            'valor_actual' => $request -> valor_actual,
            'estado_meta' => $request -> estado_meta,
            'creado_por' => $request -> creado_por,
            'actualizado_por' => $request -> actualizado_por,
        ]);

        if(!$meta_presidencia){
            $data = [
                'message' => 'Error al crear los datos',
                'status' => 500
            ];
            return response() -> json($data,500);
        }

        $data = [
            'message' => 'Meta presidencia creada correctamente',
            'data' => $meta_presidencia,
            'status' => 200
        ];
        return response() -> json($data,200);
    }

    public function show($id){
        $meta_presidencia = Meta_presidencia::find($id);

        if(!$meta_presidencia) {
            $data = [
                'message' => 'Id no encontrado',
                'status' => 404
            ];
            return response() -> json($data,404);
        }

        $data = [
            'message' => 'Meta presidencia encontrada: ',
            'data' => $meta_presidencia,
            'status' => 200
        ];
        return response() -> json($data,200);
    }

    public function delete($id){
        $meta_presidencia = Meta_presidencia::find($id);

        if(!$meta_presidencia){
            $data = [
                'message' => 'Meta presidencia no encontrada',
                'status' => 404
            ];
            return response() -> json($data,404);
        }

        $meta_presidencia -> delete();

        $data = [
            'message' => 'Meta presidencia eliminada',
            'status' => 200
        ];
        return response() -> json($data,200);
    }

    public function update(Request $request, $id){
        $meta_presidencia = Meta_presidencia::find($id);

        if(!$meta_presidencia){
            $data = [
                'message' => 'Meta presidencia no encontrada',
                'status' => 404
            ];
            return response()->json($data,404);
        }

        $validator = Validator::make($request -> all(), [
        'nombre_meta' => 'required|max:150',
        'descripcion_meta' => 'required|max:255',
        'valor_objetivo' => 'required|numeric',
        'valor_actual' => 'required|numeric',
        'estado_meta' => 'required|in:activo,inactivo',
        'creado_por' => 'required|exists:users,id',
        'actualizado_por' => 'required|exists:users,id',
        ]);

        if($validator -> fails()){
            $data = [
                'message' => 'Error en la validacion de los datos',
                'errors' => $validator -> errors(),
                'status' => 404
            ];
            return response() -> json($data,404);
        }

        $meta_presidencia -> nombre_meta = $request -> nombre_meta;
        $meta_presidencia -> valor_objetivo = $request -> valor_objetivo;
        $meta_presidencia -> valor_actual = $request -> valor_actual;
        $meta_presidencia -> estado_meta = $request -> estado_meta;
        $meta_presidencia -> creado_por = $request -> creado_por;
        $meta_presidencia -> actualizado_por = $request -> actualizado_por;
        $meta_presidencia -> save();

        $data = [
            'message' => 'Meta presidencia actualizada correctamente',
            'data' => $meta_presidencia,
            'status' => 200
        ];
        return response() -> json($data,200);
    }

    public function updatePartial(Request $request, $id){
        $meta_presidencia = Meta_presidencia::find($id);

        if(!$meta_presidencia){
            $data = [
                'message' => 'Meta presidencia no encontrada',
                'status' => 404
            ];
            return response()->json($data,404);
        }

        $validator = Validator::make($request -> all(), [
        'nombre_meta' => 'max:150',
        'descripcion_meta' => 'max:255',
        'valor_objetivo' => 'numeric',
        'valor_actual' => 'numeric',
        'estado_meta' => 'in:activo,inactivo',
        'creado_por' => 'exists:users,id',
        'actualizado_por' => 'exists:users,id'
        ]);

        if($validator -> fails()){
            $data = [
                'message' => 'Error en la validacion de los datos',
                'errors' => $validator -> errors(),
                'status' => 404
            ];
            return response() -> json($data,404);
        }

        if($request -> has('nombre_meta')){
            $meta_presidencia -> nombre_meta = $request -> nombre_meta;
        }

        if($request -> has('descripcion_meta')){
            $meta_presidencia -> descripcion_meta = $request -> descripcion_meta;
        }

        if($request -> has('valor_objetivo')){
            $meta_presidencia -> valor_objetivo = $request -> valor_objetivo;
        }

        if($request -> has('valor_actual')){
            $meta_presidencia -> valor_actual = $request -> valor_actual;
        }

        if($request -> has('estado_meta')){
            $meta_presidencia -> estado_meta = $request -> estado_meta;
        }

        if($request -> has('creado_por')){
            $meta_presidencia -> creado_por = $request -> creado_por;
        }

        if($request -> has('actualizado_por')){
            $meta_presidencia -> actualizado_por = $request -> actualizado_por;
        }

        $meta_presidencia -> save();

        $data = [
            'message' => 'Meta presidencia actualizada correctamente',
            'data' => $meta_presidencia,
            'status' => 200
        ];
        return response() -> json($data,200);
    }
}
