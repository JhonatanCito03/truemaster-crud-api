<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Registro_ejecucion;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;

class registroEjecucion extends Controller
{
    public function index()
    {
        $registro_ejecucion = Registro_ejecucion::all();

        if($registro_ejecucion -> isEmpty()){
            $data = [
                'message' => 'Parece que no existe ningun dato',
                'status' => 404
            ];
            return response() ->json($data,404);
        }

        if(!$registro_ejecucion){
            $data = [
                'message' => 'No hay datos por cargar',
                'status' => 404
            ];
            return response() -> json($data,404);
        }

        $data = [
            'message' => 'Lista de registros de ejecucion: ',
            'lista' => $registro_ejecucion,
            'status' => 200
        ];
        return response() -> json($data,200);
    }

    public function show($id)
    {
        $registro_ejecucion = Registro_ejecucion::find($id);

        if(!$registro_ejecucion){
            $data = [
                'message' => 'Id no encontrada',
                'status' => 404
            ];
            return response() -> json($data,404);
        }

        $data = [
            'message' => 'Id encontrada:',
            'data' => $registro_ejecucion,
            'status' => 200
        ];
        return response() ->json($data,200);
    }
    public function store(Request $request){
        $registro_ejecucion = Registro_ejecucion::all();

        $validator = Validator::make($request -> all(),[
            'nombre_registro' => 'required|unique:registro_ejecucion|max:150',
            'valor' => 'required',
            'empleado_id' => 'required',
            'fecha_registro' => 'required',
            'oficina_id' => 'required'
        ]);

        if($validator -> fails()){
            $data = [
                'message' => 'Error en la validacion de los datos',
                'data' => $validator -> errors(),
                'status' => 400
            ];
            return response() -> json($data,400);
        }

        $registro_ejecucion = Registro_ejecucion::create([
            //nuevos datos
            'nombre_registro' => $request -> nombre_registro,
            'valor' => $request -> valor,
            'empleado_id' => $request -> empleado_id,
            'fecha_registro' => $request -> fecha_registro,
            'oficina_id' => $request -> oficina_id
        ]);

        if(!$registro_ejecucion){
            $data = [
                'meesage' => 'Error al crear los datos',
                'status' => 404
            ];
            return response() -> json($data,404);
        }

        $data = [
            'message' => 'Nuevo registro de ejecucion creado correctamente',
            'data' => $registro_ejecucion,
            'status' => 200
        ];
        return response()->json($data,200);
    }
    public function update(Request $request, $id)
    {
        $registro_ejecucion = Registro_ejecucion::find($id);

        if (!$registro_ejecucion) {
            return response()->json([
                'message' => 'Id no encontrado',
                'status' => 404
            ], 404);
        }

        $validator = Validator::make($request->all(), [
            //esta parte es un poco mas compleja, por lo que se requiere mas investigacion
            'nombre_registro' => 'required|unique:registro_ejecucion,nombre_registro,' . $id . '|max:150',
            'valor' => 'required' . $id,
            'empleado_id' => 'required',
            'fecha_registro' => 'required',
            'oficina_id' => 'required'
        ]);
        if ($validator->fails()) {
            return response()->json([
                'message' => 'Error en la validación de los datos',
                'errors' => $validator->errors(),
                'status' => 400
            ], 400);
        }

        $registro_ejecucion->nombre_registro = $request -> nombre_registro;
        $registro_ejecucion -> valor = $request -> valor;
        $registro_ejecucion -> empleado_id = $request -> empleado_id;
        $registro_ejecucion -> fecha_registro = $request -> fecha_registro;
        $registro_ejecucion -> oficina_id = $request -> oficina_id;
        $registro_ejecucion->save();

        return response()->json([
            'message' => 'Datos actualizados correctamente',
            'data' => $registro_ejecucion,
            'status' => 200
        ], 200);
    }

    public function updatePartial(Request $request,$id)
    {
        $registro_ejecucion = Registro_ejecucion::find($id);

        if(!$registro_ejecucion){
            $data = [
                'message' => 'No se ha encontrado el id',
                'status' => 404
            ];
            return response() -> json($data,404);
        }

        $validator = Validator::make($request -> all(), [
             //esta parte es un poco mas compleja, por lo que se requiere mas investigacion
            'nombre_registro' => 'max:150|unique:registro_ejecucion,nombre_registro,' . $id,
            'valor',
            'empleado_id',
            'fecha_registro',
            'oficina_id'
        ]);

        if($validator -> fails()){
            $data = [
                'message'=>'Error en la validacion de los datos',
                'data' => $validator->errors(),
                'status' => 404
            ];
            return response($data,404);
        }

        if($request -> has('nombre_registro')){
            $registro_ejecucion->nombre_registro = $request -> nombre_registro;
        }
        if($request -> has('valor')){
            $registro_ejecucion -> valor = $request -> valor;
        }
        if($request -> has('empleado_id')){
            $registro_ejecucion -> empleado_id = $request -> empleado_id;
        }
        if($request -> has('fecha_registro')){
            $registro_ejecucion -> fecha_registro = $request -> fecha_registro;
        }
        if($request -> has('oficina_id')){
            $registro_ejecucion -> oficina_id = $request -> oficina_id;
        }
        $registro_ejecucion -> save();

        return response() -> json([
            'message' => 'Datos actualizados correctamente',
            'data' => $registro_ejecucion,
            'status' => 200
        ],200);
    }

    public function delete($id)
    {
        $registro_ejecucion = Registro_ejecucion::find($id);

        if(!$registro_ejecucion){
            $data = [
                'message' => 'Id no encontrada',
                'status' => 404
            ];
            return response() -> json($data,404);
        }

        $registro_ejecucion -> delete();

        $data = [
            'message' => 'Registro eliminado correctamente',
            'status' => 200
        ];
        return response() -> json($data,200);
    }
}
