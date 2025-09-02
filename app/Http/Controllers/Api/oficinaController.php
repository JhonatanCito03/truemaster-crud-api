<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Oficina;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class oficinaController extends Controller
{
    public function index(){
        $oficina = Oficina::all();

        if($oficina -> isEmpty()){
            $data = [
                'message' => 'No hay datos',
                'status' => 200
            ];
            return response() -> json($data,200);
        }

        if(!$oficina){
            $data = [
                'message' => 'No hay oficinas',
                'status' => 404
            ];
            return response() ->json($data,404);
        }

        $data = [
            'message' => 'Lista de oficinas',
            'data' => $oficina,
            'status' => 200
        ];
        return response() -> json($data,200);
    }

    public function store(Request $request) {
        $oficina = Oficina::all();

        $validator = Validator::make($request -> all(), [
        'nombre_oficina' => 'required|max:150',
        'codigo_oficina' => 'required|max:10',
        'direccion' => 'required|max:250',
        'telefono' => 'required|integer',
        'email_contacto' => 'required|email',
        'horario_atencion' => 'required',
        'activo' => 'required',
        'responsable_id' => 'required',
        'municipio_id' => 'required'
        ]);

        if($validator ->fails()){
            $data = [
                'message' => 'Error en la validacion de los datos: ',
                'errors' => $validator -> errors(),
                'status' => 404
            ];
            return response()->json($data,404);
        }

        $oficina = Oficina::create([
            'nombre_oficina' => $request -> nombre_oficina,
            'codigo_oficina' => $request -> codigo_oficina,
            'direccion' => $request -> direccion,
            'telefono' => $request -> telefono,
            'email_contacto' => $request -> email_contacto,
            'horario_atencion' => $request -> horario_atencion,
            'activo' => $request -> activo,
            'responsable_id' => $request -> responsable_id,
            'municipio_id' => $request -> municipio_id,
        ]);

        if(!$oficina){
            $data = [
                'message' => 'Error al crear los datos',
                'status' => 500
            ];
            return response() -> json($data,500);
        }

        $data = [
            'message' => 'Oficina creada correctamente',
            'oficina' => $oficina,
            'status' => 200
        ];
        return response() -> json($data,200);
    }

    public function show($id){
        $oficina = Oficina::find($id);

        if(!$oficina) {
            $data = [
                'message' => 'Id no encontrado',
                'status' => 404
            ];
            return response() -> json($data,404);
        }

        $data = [
            'message' => 'Oficina encontrada: ',
            'data' => $oficina,
            'status' => 200
        ];
        return response() -> json($data,200);
    }

    public function delete($id){
        $oficina = Oficina::find($id);

        if(!$oficina){
            $data = [
                'message' => 'Oficina no encontrada',
                'status' => 404
            ];
            return response() -> json($data,404);
        }

        $oficina ->  delete();

        $data = [
            'message' => 'Oficina eliminada',
            'status' => 200
        ];
        return response() -> json($data,200);
    }

    public function update(Request $request, $id){
        $oficina = Oficina::find($id);

        if(!$oficina){
            $data = [
                'message' => 'Oficina no encontrada',
                'status' => 404
            ];
            return response()->json($data,404);
        }

        $validator = Validator::make($request -> all(), [
        'nombre_oficina' => 'required|max:150',
        'codigo_oficina' => 'required|max:10',
        'direccion' => 'required|max:250',
        'telefono' => 'required|integer|min:6|max:20',
        'email_contacto' => 'required|email',
        'horario_atencion' => 'required',
        'activo' => 'required',
        'responsable_id' => 'required|unique:oficina',
        'municipio_id' => 'required'
        ]);

        if($validator -> fails()){
            $data = [
                'message' => 'Error en la validacion de los datos',
                'errors' => $validator -> errors(),
                'status' => 404
            ];
            return response() -> json($data,404);
        }

        $oficina -> nombre_oficina = $request -> nombre_oficina;
        $oficina -> codigo_oficina = $request -> codigo_oficina;
        $oficina -> direccion = $request -> direccion;
        $oficina -> telefono = $request -> telefono;
        $oficina -> email_contacto = $request -> email_contacto;
        $oficina -> horario_atencion = $request -> horario_atencion;
        $oficina -> activo = $request -> activo;
        $oficina -> responsable_id = $request -> responsable_id;
        $oficina -> municipio_id = $request -> municipio_id;

        $oficina -> save();

        $data = [
            'message' => 'Oficina actualizada correctamente',
            'data' => $oficina,
            'status' => 200
        ];
        return response() -> json($data,200);
    }

    public function updatePartial(Request $request, $id){
        $oficina = Oficina::find($id);

        if(!$oficina){
            $data = [
                'message' => 'Oficina no encontrada',
                'status' => 404
            ];
            return response()->json($data,404);
        }

        $validator = Validator::make($request -> all(), [
        'nombre_oficina',
        'codigo_oficina',
        'direccion',
        'telefono',
        'email_contacto' => 'email',
        'horario_atencion',
        'activo',
        'responsable_id',
        'municipio_id' 
        ]);

        if($validator -> fails()){
            $data = [
                'message' => 'Error en la validacion de los datos',
                'errors' => $validator -> errors(),
                'status' => 404
            ];
            return response() -> json($data,404);
        }

        if($request -> has('nombre_oficina')){
            $oficina -> nombre_oficina = $request -> nombre_oficina;
        }
        
        if($request -> has('codigo_oficina')){
            $oficina -> codigo_oficina = $request -> codigo_oficina;
        }
        if($request -> has('direccion')){
            $oficina -> direccion = $request -> direccion;
        }
        if($request -> has('telefono')){
            $oficina -> telefono = $request -> telefono;
        }
        if($request -> has('email_contacto')){
            $oficina -> email_contacto = $request -> email_contacto;
        }
        if($request -> has('horario_atencion')){
            $oficina -> horario_atencion = $request -> horario_atencion;
        }
        if($request -> has('activo')){
            $oficina -> activo = $request -> activo;
        }
        if($request -> has('responsable_id')){
            $oficina -> responsable_id = $request -> responsable_id;
        }
        if($request -> has('municipio_id')){
            $oficina -> municipio_id = $request -> municipio_id;
        }
        
        $oficina -> save();

        $data = [
            'message' => 'Oficina actualizada correctamente',
            'data' => $oficina,
            'status' => 200
        ];
        return response() -> json($data,200);
    }
}
