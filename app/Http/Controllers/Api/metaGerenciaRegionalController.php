<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Meta_gerencia_regional;
use illuminate\Support\Facades\Validator;

class metaGerenciaRegionalController extends Controller
{
    public function index(){
        $meta_gerencia_regional = Meta_gerencia_regional::all();

        if($meta_gerencia_regional -> isEmpty()){
            $data = [
                'message' => 'No hay datos',
                'status' => 200
            ];
            return response() -> json($data,200);
        }

        if(!$meta_gerencia_regional){
            $data = [
                'message' => 'No hay metas de gerencia regional disponibles',
                'status' => 404
            ];
            return response() ->json($data,404);
        }

        $data = [
            'message' => 'Lista de metas de gerencia regional',
            'data' => $meta_gerencia_regional,
            'status' => 200
        ];
        return response() -> json($data,200);
    }

    public function store(Request $request) {
        $meta_gerencia_regional = Meta_gerencia_regional::all();

        $validator = Validator::make($request -> all(), [
        'nombre_meta' => 'required|max:150',
        'valor_objetivo' => 'required',
        'valor_actual' => 'required',
        'meta_presidencia_id' => 'required|exists:meta_presidencia,id',
        'estado_meta' => 'required|boolean',
        'creado_por' => 'required|max:100',
        'actualizado_por' => 'nullable|max:100',
        'region_id' => 'required|exists:region,id',
        ]);

        if($validator ->fails()){
            $data = [
                'message' => 'Error en la validacion de los datos: ',
                'errors' => $validator -> errors(),
                'status' => 404
            ];
            return response()->json($data,404);
        }

        $meta_gerencia_regional = Meta_gerencia_regional::create([
            'nombre_meta' => $request -> nombre_meta,
            'valor_objetivo' => $request -> valor_objetivo,
            'valor_actual' => $request -> valor_actual,
            'meta_presidencia_id' => $request -> meta_presidencia_id,
            'estado_meta' => $request -> estado_meta,
            'creado_por' => $request -> creado_por,
            'actualizado_por' => $request -> actualizado_por,
            'region_id' => $request -> region_id
        ]);

        if(!$meta_gerencia_regional){
            $data = [
                'message' => 'Error al crear los datos',
                'status' => 500
            ];
            return response() -> json($data,500);
        }

        $data = [
            'message' => 'Meta gerencia regional creada correctamente',
            'region' => $meta_gerencia_regional,
            'status' => 200
        ];
        return response() -> json($data,200);
    }

    public function show($id){
        $meta_gerencia_regional = Meta_gerencia_regional::find($id);

        if(!$meta_gerencia_regional) {
            $data = [
                'message' => 'Id no encontrado',
                'status' => 404
            ];
            return response() -> json($data,404);
        }

        $data = [
            'message' => 'Meta gerencia regional encontrada: ',
            'data' => $meta_gerencia_regional,
            'status' => 200
        ];
        return response() -> json($data,200);
    }

    public function delete($id){
        $meta_gerencia_regional = Meta_gerencia_regional::find($id);

        if(!$meta_gerencia_regional){
            $data = [
                'message' => 'Meta gerencia regional no encontrada',
                'status' => 404
            ];
            return response() -> json($data,404);
        }

        $meta_gerencia_regional -> delete();

        $data = [
            'message' => 'Meta gerencia regional eliminada',
            'status' => 200
        ];
        return response() -> json($data,200);
    }

    public function update(Request $request, $id){
        $meta_gerencia_regional = Meta_gerencia_regional::find($id);

        if(!$meta_gerencia_regional){
            $data = [
                'message' => 'Meta gerencia regional no encontrada',
                'status' => 404
            ];
            return response()->json($data,404);
        }

        $validator = Validator::make($request -> all(), [
        'nombre_meta' => 'required|max:150',
        'valor_objetivo' => 'required|numeric',
        'valor_actual' => 'required|numeric',
        'meta_presidencia_id' => 'required|exists:meta_gerencia_zonal,id',
        'estado_meta' => 'required|in:activo,inactivo',
        'creado_por' => 'required|exists:users,id',
        'actualizado_por' => 'required|exists:users,id',
        'region_id' => 'required|exists:region,id'
        ]);

        if($validator -> fails()){
            $data = [
                'message' => 'Error en la validacion de los datos',
                'errors' => $validator -> errors(),
                'status' => 404
            ];
            return response() -> json($data,404);
        }

        $meta_gerencia_regional -> nombre_meta = $request -> nombre_meta;
        $meta_gerencia_regional -> valor_objetivo = $request -> valor_objetivo;
        $meta_gerencia_regional -> valor_actual = $request -> valor_actual;
        $meta_gerencia_regional -> meta_presidencia_id = $request -> meta_presidencia_id;
        $meta_gerencia_regional -> estado_meta = $request -> estado_meta;
        $meta_gerencia_regional -> creado_por = $request -> creado_por;
        $meta_gerencia_regional -> actualizado_por = $request -> actualizado_por;
        $meta_gerencia_regional -> region_id = $request -> region_id;
        $meta_gerencia_regional -> save();

        $data = [
            'message' => 'Meta regional actualizada correctamente',
            'data' => $meta_gerencia_regional,
            'status' => 200
        ];
        return response() -> json($data,200);
    }

    public function updatePartial(Request $request, $id){
        $meta_gerencia_regional = Meta_gerencia_regional::find($id);

        if(!$meta_gerencia_regional){
            $data = [
                'message' => 'Meta gerencia regional no encontrada',
                'status' => 404
            ];
            return response()->json($data,404);
        }

        $validator = Validator::make($request -> all(), [
        'nombre_meta' => 'required|max:150',
        'valor_objetivo' => 'required|numeric',
        'valor_actual' => 'required|numeric',
        'meta_presidencia_id' => 'required|exists:meta_gerencia_zonal,id',
        'estado_meta' => 'required|in:activo,inactivo',
        'creado_por' => 'required|exists:users,id',
        'actualizado_por' => 'required|exists:users,id',
        'region_id' => 'required|exists:region,id'
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
            $meta_gerencia_regional -> nombre_meta = $request -> nombre_meta;
        }

        if($request -> has('valor_objetivo')){
            $meta_gerencia_regional -> valor_objetivo = $request -> valor_objetivo;
        }

        if($request -> has('valor_actual')){
            $meta_gerencia_regional -> valor_actual = $request -> valor_actual;
        }

        if($request -> has('meta_presidencia_id')){
            $meta_gerencia_regional -> meta_presidencia_id = $request -> meta_presidencia_id;
        }

        if($request -> has('estado_meta')){
            $meta_gerencia_regional -> estado_meta = $request -> estado_meta;
        }

        if($request -> has('creado_por')){
            $meta_gerencia_regional -> creado_por = $request -> creado_por;
        }

        if($request -> has('actualizado_por')){
            $meta_gerencia_regional -> actualizado_por = $request -> actualizado_por;
        }

        if($request -> has('region_id')){
            $meta_gerencia_regional -> region_id = $request -> region_id;
        }
        $meta_gerencia_regional -> save();

        $data = [
            'message' => 'Meta regional actualizada correctamente',
            'data' => $meta_gerencia_regional,
            'status' => 200
        ];
        return response() -> json($data,200);
    }
}
