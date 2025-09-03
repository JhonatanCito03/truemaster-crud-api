<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Meta_gerencia_oficina;
use illuminate\Support\Facades\Validator;

class metaGerenciaOficinaController extends Controller
{
    public function index(){
        $meta_gerencia_oficina = Meta_gerencia_oficina::all();

        if($meta_gerencia_oficina -> isEmpty()){
            $data = [
                'message' => 'No hay datos',
                'status' => 200
            ];
            return response() -> json($data,200);
        }

        if(!$meta_gerencia_oficina){
            $data = [
                'message' => 'No hay oficinas',
                'status' => 404
            ];
            return response() ->json($data,404);
        }

        $data = [
            'message' => 'Lista de metas de oficina',
            'data' => $meta_gerencia_oficina,
            'status' => 200
        ];
        return response() -> json($data,200);
    }

    public function store(Request $request) {
        $meta_gerencia_oficina = Meta_gerencia_oficina::all();

        $validator = Validator::make($request -> all(), [
        'nombre_meta' => 'required|max:150',
        'valor_objetivo' => 'required',
        'valor_actual' => 'required',
        'meta_gerencia_zonal_id' => 'required|exists:meta_gerencia_zonal,id',
        'estado_meta' => 'required|boolean',
        'creado_por' => 'required|max:100',
        'actualizado_por' => 'nullable|max:100',
        'oficina_id' => 'required|exists:oficina,id',
        ]);

        if($validator ->fails()){
            $data = [
                'message' => 'Error en la validacion de los datos: ',
                'errors' => $validator -> errors(),
                'status' => 404
            ];
            return response()->json($data,404);
        }

        $meta_gerencia_oficina = Meta_gerencia_oficina::create([
            'nombre_meta' => $request -> nombre_meta,
            'valor_objetivo' => $request -> valor_objetivo,
            'valor_actual' => $request -> valor_actual,
            'meta_gerencia_zonal_id' => $request -> meta_gerencia_zonal_id,
            'estado_meta' => $request -> estado_meta,
            'creado_por' => $request -> creado_por,
            'actualizado_por' => $request -> actualizado_por,
            'oficina_id' => $request -> oficina_id
        ]);

        if(!$meta_gerencia_oficina){
            $data = [
                'message' => 'Error al crear los datos',
                'status' => 500
            ];
            return response() -> json($data,500);
        }

        $data = [
            'message' => 'Meta gerencia de oficina creada correctamente',
            'oficina' => $meta_gerencia_oficina,
            'status' => 200
        ];
        return response() -> json($data,200);
    }

    public function show($id){
        $meta_gerencia_oficina = Meta_gerencia_oficina::find($id);

        if(!$meta_gerencia_oficina) {
            $data = [
                'message' => 'Id no encontrado',
                'status' => 404
            ];
            return response() -> json($data,404);
        }

        $data = [
            'message' => 'Meta gerencia de oficina encontrada: ',
            'data' => $meta_gerencia_oficina,
            'status' => 200
        ];
        return response() -> json($data,200);
    }

    public function delete($id){
        $meta_gerencia_oficina = Meta_gerencia_oficina::find($id);

        if(!$meta_gerencia_oficina){
            $data = [
                'message' => 'Meta gerencia de oficina no encontrada',
                'status' => 404
            ];
            return response() -> json($data,404);
        }

        $meta_gerencia_oficina -> delete();

        $data = [
            'message' => 'Meta gerencia de oficina eliminada',
            'status' => 200
        ];
        return response() -> json($data,200);
    }

    public function update(Request $request, $id){
        $meta_gerencia_oficina = Meta_gerencia_oficina::find($id);

        if(!$meta_gerencia_oficina){
            $data = [
                'message' => 'Meta gerencia de oficina no encontrada',
                'status' => 404
            ];
            return response()->json($data,404);
        }

        $validator = Validator::make($request -> all(), [
        'nombre_meta' => 'required|max:150',
        'valor_objetivo' => 'required|numeric',
        'valor_actual' => 'required|numeric',
        'meta_gerencia_zonal_id' => 'required|exists:meta_gerencia_zonal,id',
        'estado_meta' => 'required|in:activo,inactivo',
        'creado_por' => 'required|exists:users,id',
        'actualizado_por' => 'required|exists:users,id',
        'oficina_id' => 'required|exists:oficina,id'
        ]);

        if($validator -> fails()){
            $data = [
                'message' => 'Error en la validacion de los datos',
                'errors' => $validator -> errors(),
                'status' => 404
            ];
            return response() -> json($data,404);
        }

        $meta_gerencia_oficina -> nombre_meta = $request -> nombre_meta;
        $meta_gerencia_oficina -> valor_objetivo = $request -> valor_objetivo;
        $meta_gerencia_oficina -> valor_actual = $request -> valor_actual;
        $meta_gerencia_oficina -> meta_gerencia_zonal_id = $request -> meta_gerencia_zonal_id;
        $meta_gerencia_oficina -> estado_meta = $request -> estado_meta;
        $meta_gerencia_oficina -> creado_por = $request -> creado_por;
        $meta_gerencia_oficina -> actualizado_por = $request -> actualizado_por;
        $meta_gerencia_oficina -> oficina_id = $request -> oficina_id;
        $meta_gerencia_oficina -> save();

        $data = [
            'message' => 'Oficina actualizada correctamente',
            'data' => $meta_gerencia_oficina,
            'status' => 200
        ];
        return response() -> json($data,200);
    }

    public function updatePartial(Request $request, $id){
        $meta_gerencia_oficina = Meta_gerencia_oficina::find($id);

        if(!$meta_gerencia_oficina){
            $data = [
                'message' => 'Meta gerencia de oficina no encontrada',
                'status' => 404
            ];
            return response()->json($data,404);
        }

        $validator = Validator::make($request -> all(), [
        'nombre_meta' => 'required|max:150',
        'valor_objetivo' => 'required|numeric',
        'valor_actual' => 'required|numeric',
        'meta_gerencia_zonal_id' => 'required|exists:meta_gerencia_zonal,id',
        'estado_meta' => 'required|in:activo,inactivo',
        'creado_por' => 'required|exists:users,id',
        'actualizado_por' => 'required|exists:users,id',
        'oficina_id' => 'required|exists:oficina,id'
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
            $meta_gerencia_oficina -> nombre_meta = $request -> nombre_meta;
        }

        if($request -> has('valor_objetivo')){
            $meta_gerencia_oficina -> valor_objetivo = $request -> valor_objetivo;
        }

        if($request -> has('valor_actual')){
            $meta_gerencia_oficina -> valor_actual = $request -> valor_actual;
        }

        if($request -> has('meta_gerencia_zonal_id')){
            $meta_gerencia_oficina -> meta_gerencia_zonal_id = $request -> meta_gerencia_zonal_id;
        }

        if($request -> has('estado_meta')){
            $meta_gerencia_oficina -> estado_meta = $request -> estado_meta;
        }

        if($request -> has('creado_por')){
            $meta_gerencia_oficina -> creado_por = $request -> creado_por;
        }

        if($request -> has('actualizado_por')){
            $meta_gerencia_oficina -> actualizado_por = $request -> actualizado_por;
        }

        if($request -> has('oficina_id')){
            $meta_gerencia_oficina -> oficina_id = $request -> oficina_id;
        }
        $meta_gerencia_oficina -> save();

        $data = [
            'message' => 'Oficina actualizada correctamente',
            'data' => $meta_gerencia_oficina,
            'status' => 200
        ];
        return response() -> json($data,200);
    }
}
