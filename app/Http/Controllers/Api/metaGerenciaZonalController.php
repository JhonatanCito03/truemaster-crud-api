<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Meta_gerencia_zonal;
use illuminate\Support\Facades\Validator;

class metaGerenciaZonalController extends Controller
{
 public function index(){
        $meta_gerencia_zonal = Meta_gerencia_zonal::all();

        if($meta_gerencia_zonal -> isEmpty()){
            $data = [
                'message' => 'No hay datos',
                'status' => 200
            ];
            return response() -> json($data,200);
        }

        if(!$meta_gerencia_zonal){
            $data = [
                'message' => 'No hay metas de gerencia zonal disponibles',
                'status' => 404
            ];
            return response() ->json($data,404);
        }

        $data = [
            'message' => 'Lista de metas de gerencia zonal',
            'data' => $meta_gerencia_zonal,
            'status' => 200
        ];
        return response() -> json($data,200);
    }

    public function store(Request $request) {
        $meta_gerencia_zonal = Meta_gerencia_zonal::all();

        $validator = Validator::make($request -> all(), [
        'nombre_meta' => 'required|max:150',
        'valor_objetivo' => 'required',
        'valor_actual' => 'required',
        'meta_gerencia_regional_id' => 'required|exists:meta_gerencia_regional,id',
        'estado_meta' => 'required|boolean',
        'creado_por' => 'required|max:100',
        'actualizado_por' => 'nullable|max:100',
        'municipio_id' => 'required|exists:municipio,id',
        ]);

        if($validator ->fails()){
            $data = [
                'message' => 'Error en la validacion de los datos: ',
                'errors' => $validator -> errors(),
                'status' => 404
            ];
            return response()->json($data,404);
        }

        $meta_gerencia_zonal = Meta_gerencia_zonal::create([
            'nombre_meta' => $request -> nombre_meta,
            'valor_objetivo' => $request -> valor_objetivo,
            'valor_actual' => $request -> valor_actual,
            'meta_gerencia_regional_id' => $request -> meta_gerencia_regional_id,
            'estado_meta' => $request -> estado_meta,
            'creado_por' => $request -> creado_por,
            'actualizado_por' => $request -> actualizado_por,
            'municipio_id' => $request -> municipio_id
        ]);

        if(!$meta_gerencia_zonal){
            $data = [
                'message' => 'Error al crear los datos',
                'status' => 500
            ];
            return response() -> json($data,500);
        }

        $data = [
            'message' => 'Meta gerencia zonal creada correctamente',
            'region' => $meta_gerencia_zonal,
            'status' => 200
        ];
        return response() -> json($data,200);
    }

    public function show($id){
        $meta_gerencia_zonal = Meta_gerencia_zonal::find($id);

        if(!$meta_gerencia_zonal) {
            $data = [
                'message' => 'Id no encontrado',
                'status' => 404
            ];
            return response() -> json($data,404);
        }

        $data = [
            'message' => 'Meta gerencia zonal encontrada: ',
            'data' => $meta_gerencia_zonal,
            'status' => 200
        ];
        return response() -> json($data,200);
    }

    public function delete($id){
        $meta_gerencia_zonal = Meta_gerencia_zonal::find($id);

        if(!$meta_gerencia_zonal){
            $data = [
                'message' => 'Meta gerencia zonal no encontrada',
                'status' => 404
            ];
            return response() -> json($data,404);
        }

        $meta_gerencia_zonal -> delete();

        $data = [
            'message' => 'Meta gerencia zonal eliminada',
            'status' => 200
        ];
        return response() -> json($data,200);
    }

    public function update(Request $request, $id){
        $meta_gerencia_zonal = Meta_gerencia_zonal::find($id);

        if(!$meta_gerencia_zonal){
            $data = [
                'message' => 'Meta gerencia zonal no encontrada',
                'status' => 404
            ];
            return response()->json($data,404);
        }

        $validator = Validator::make($request -> all(), [
        'nombre_meta' => 'required|max:150',
        'valor_objetivo' => 'required|numeric',
        'valor_actual' => 'required|numeric',
        'meta_gerencia_regional_id' => 'required|exists:meta_gerencia_regional,id',
        'estado_meta' => 'required|in:activo,inactivo',
        'creado_por' => 'required|exists:users,id',
        'actualizado_por' => 'required|exists:users,id',
        'municipio_id' => 'required|exists:municipio,id'
        ]);

        if($validator -> fails()){
            $data = [
                'message' => 'Error en la validacion de los datos',
                'errors' => $validator -> errors(),
                'status' => 404
            ];
            return response() -> json($data,404);
        }

        $meta_gerencia_zonal -> nombre_meta = $request -> nombre_meta;
        $meta_gerencia_zonal -> valor_objetivo = $request -> valor_objetivo;
        $meta_gerencia_zonal -> valor_actual = $request -> valor_actual;
        $meta_gerencia_zonal -> meta_gerencia_regional_id = $request -> meta_gerencia_regional_id;
        $meta_gerencia_zonal -> estado_meta = $request -> estado_meta;
        $meta_gerencia_zonal -> creado_por = $request -> creado_por;
        $meta_gerencia_zonal -> actualizado_por = $request -> actualizado_por;
        $meta_gerencia_zonal -> municipio_id = $request -> municipio_id;
        $meta_gerencia_zonal -> save();

        $data = [
            'message' => 'Meta zonal actualizada correctamente',
            'data' => $meta_gerencia_zonal,
            'status' => 200
        ];
        return response() -> json($data,200);
    }

    public function updatePartial(Request $request, $id){
        $meta_gerencia_zonal = Meta_gerencia_zonal::find($id);

        if(!$meta_gerencia_zonal){
            $data = [
                'message' => 'Meta gerencia zonal no encontrada',
                'status' => 404
            ];
            return response()->json($data,404);
        }

        $validator = Validator::make($request -> all(), [
        'nombre_meta' => 'required|max:150',
        'valor_objetivo' => 'required|numeric',
        'valor_actual' => 'required|numeric',
        'meta_gerencia_regional_id' => 'required|exists:meta_gerencia_regional,id',
        'estado_meta' => 'required|in:activo,inactivo',
        'creado_por' => 'required|exists:users,id',
        'actualizado_por' => 'required|exists:users,id',
        'municipio_id' => 'required|exists:municipio,id'
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
            $meta_gerencia_zonal -> nombre_meta = $request -> nombre_meta;
        }

        if($request -> has('valor_objetivo')){
            $meta_gerencia_zonal -> valor_objetivo = $request -> valor_objetivo;
        }

        if($request -> has('valor_actual')){
            $meta_gerencia_zonal -> valor_actual = $request -> valor_actual;
        }

        if($request -> has('meta_gerencia_regional_id')){
            $meta_gerencia_zonal -> meta_gerencia_regional_id = $request -> meta_gerencia_regional_id;
        }

        if($request -> has('estado_meta')){
            $meta_gerencia_zonal -> estado_meta = $request -> estado_meta;
        }

        if($request -> has('creado_por')){
            $meta_gerencia_zonal -> creado_por = $request -> creado_por;
        }

        if($request -> has('actualizado_por')){
            $meta_gerencia_zonal -> actualizado_por = $request -> actualizado_por;
        }

        if($request -> has('municipio_id')){
            $meta_gerencia_zonal -> municipio_id = $request -> municipio_id;
        }
        $meta_gerencia_zonal -> save();

        $data = [
            'message' => 'Meta zonal actualizada correctamente',
            'data' => $meta_gerencia_zonal,
            'status' => 200
        ];
        return response() -> json($data,200);
    }
}
