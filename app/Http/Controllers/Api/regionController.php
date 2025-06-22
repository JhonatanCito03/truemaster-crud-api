<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Region;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;

class regionController extends Controller
{
    public function index()
    {
        $region = Region::all();

        if($region -> isEmpty()){
            $data = [
                'message' => 'Parece que no existe ningun dato',
                'status' => 404
            ];
            return response() ->json($data,404);
        }

        if(!$region){
            $data = [
                'message' => 'No hay datos por cargar',
                'status' => 404
            ];
            return response() -> json($data,404);
        }

        $data = [
            'message' => 'Lista de regiones: ',
            'lista' => $region,
            'status' => 200
        ];
        return response() -> json($data,200);
    }

    public function show($id)
    {
        $region = Region::find($id);

        if(!$region){
            $data = [
                'message' => 'Id no encontrada',
                'status' => 404
            ];
            return response() -> json($data,404);
        }

        $data = [
            'message' => 'Id encontrada:',
            'data' => $region,
            'status' => 200
        ];
        return response() ->json($data,200);
    }
    public function store(Request $request){
        $region = Region::all();

        $validator = Validator::make($request -> all(),[
            'nombre_region' => 'required|unique:region',
            'zona' => 'required'
        ]);

        if($validator -> fails()){
            $data = [
                'message' => 'Error en la validacion de los datos',
                'data' => $validator -> errors(),
                'status' => 400
            ];
            return response() -> json($data,400);
        }

        $region = Region::create([
            'nombre_region' => $request -> nombre_region,
            'zona' => $request -> zona
        ]);

        if(!$region){
            $data = [
                'meesage' => 'Error al crear los datos',
                'status' => 404
            ];
            return response() -> json($data,404);
        }

        $data = [
            'message' => 'Nueva region creada correctamente',
            'data' => $region,
            'status' => 200
        ];
        return response()->json($data,200);
    }
    public function update(Request $request, $id)
    {
        $region = Region::find($id);

        if (!$region) {
            return response()->json([
                'message' => 'Id no encontrado',
                'status' => 404
            ], 404);
        }

        $validator = Validator::make($request->all(), [
            'nombre_region' => 'required|unique:region,nombre_region,' . $id,
            'zona' => 'required'
        ]);

        if ($validator->fails()) {
            return response()->json([
                'message' => 'Error en la validación de los datos',
                'errors' => $validator->errors(),
                'status' => 400
            ], 400);
        }

        $region->nombre_region = $request->nombre_region;
        $region->zona = $request->zona;
        $region->save();

        return response()->json([
            'message' => 'Datos actualizados correctamente',
            'data' => $region,
            'status' => 200
        ], 200);
    }

    public function updatePartial(Request $request,$id)
    {
        $region = Region::find($id);

        if(!$region){
            $data = [
                'message' => 'No se ha encontrado el id',
                'status' => 404
            ];
            return response() -> json($data,404);
        }

        $validator = Validator::make($request -> all(), [
            'nombre_region' => 'unique:region,nombre_region,' . $id,
            'zona',
        ]);

        if($validator -> fails()){
            $data = [
                'message'=>'Error en la validacion de los datos',
                'data' => $validator->errors(),
                'status' => 404
            ];
            return response($data,404);
        }

        if($request -> has('nombre_region')){
            $region -> nombre_region = $request -> nombre_region;
        }

        if($request -> has('zona')){
            $region -> zona = $request -> zona;
        }
        $region -> save();

        return response() -> json([
            'message' => 'Datos actualizados correctamente',
            'data' => $region,
            'status' => 200
        ],200);
    }

    public function delete($id)
    {
        $region = Region::find($id);

        if(!$region){
            $data = [
                'message' => 'Id no encontrada',
                'status' => 404
            ];
            return response() -> json($data,404);
        }

        $region -> delete();

        $data = [
            'message' => 'Region eliminada correctamente',
            'status' => 200
        ];
        return response() -> json($data,200);
    }
}
