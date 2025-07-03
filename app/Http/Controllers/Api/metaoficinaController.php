<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Metaoficina;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class metaoficinaController extends Controller
{
    public function index() 
    {
        $metaoficina = Metaoficina::all();

        if($metaoficina->isEmpty())
        {
            $data = [
                'messsage' => 'No hay metas para mostrar',
                'status' => 200
            ];
            return response()->json($data, 404);
        }

        $data = [
            'metas' => $metaoficina,
            'status' => 200
        ];
        return response()->json($data,200);
    }

    public function store(Request $request) 
    {
        $metaoficina = Metaoficina::all();

        $validator = Validator::make($request -> all(), [
            'titulo_meta' => 'required|max:100',
            'descripcion_meta' => 'required',
            'valor_objetivo' => 'required',
            'unidad' => 'required',
            'fecha_inicio' => 'required',
            'fecha_fin' => 'required',
            'activo' => 'required',
            'oficina_id' => 'required'
        ]);

        if($validator->fails()){
            $data = [
                'message' => 'Error en la validacion de los datos',
                'errors' => $validator->errors(),
                'status' => 400
            ];

            return response() -> json($data,400);
        }

        $metaoficina = Metaoficina::create([
        'titulo_meta' => $request -> titulo_meta,
        'descripcion_meta' => $request -> descripcion_meta,
        'valor_objetivo' => $request -> valor_objetivo,
        'unidad' => $request -> unidad,
        'fecha_inicio' => $request -> fecha_inicio,
        'fecha_fin' => $request -> fecha_fin,
        'activo' => $request -> activo,
        'oficina_id' => $request -> oficina_id
        ]);

        if(!$metaoficina) {
            $data = [
                'message' => 'Error al crear las metas',
                'status' => 500
            ];
             return response()->json($data, 500);
        }

        $data = [
            'metas' => $metaoficina,
            'status' => 201
        ];
        return response()->json($data,201);


    }

    public function show($id)
    {
        $metaoficina = Metaoficina::find($id);

        if(!$metaoficina){
            $data = [
                'message' => 'Ese id no corresponde a ninguna meta',
                'status' => 404
            ];
            return response()->json($data,404);
        }

        $data = [
            'message' => $metaoficina,
            'status' => 200
        ];
        return response()->json($data,200);
    }

    public function delete($id)
    {
        $metaoficina = Metaoficina::find($id);

        if(!$metaoficina){
            $data = [
                'message' => 'No se encontro el id',
                'status' => 404
            ];
            return response()->json($data,404);
        }

        $metaoficina->delete();

        $data = [
            'message' => 'Meta eliminada',
            'status' => 200
        ];
        return response()->json($data,200);
    }

    public function update(Resquest $request,$id)
    {
        $metaoficina = Metaoficina::find($id);

        if(!$metaoficina){
            $data = [
                'message' => 'Meta no encontrada',
                'status' => 404
            ];
            return response()->json($data,404);
        }

        $validator = Validator::make($request->all(), [
        'titulo_meta',
        'descripcion_meta',
        'valor_objetivo',
        'unidad',
        'fecha_inicio',
        'fecha_fin',
        'activo',
        'oficina_id'
        ]);

        if($validator->fails()){
            $data = [
                'message' => 'Error en la validacion de los datos',
                'errros' => $validator->errors(),
                'status' => 400
            ];

            return response()->json($data,400);
        }

        $metaoficina->departamento_id = $request->departamento_id;
        $metaoficina->titulo = $request->titulo;
        $metaoficina->descripcion = $request->descripcion;
        $metaoficina->valor_objetivo = $request->valor_objetivo;
        $metaoficina->unidad = $request->unidad;
        $metaoficina->fecha_inicio = $request->fecha_inicio;
        $metaoficina->fecha_fin = $request->fecha_fin;
        $metaoficina->estado = $request->estado;

        $metaoficina->save();
        
        $data = [
            'message'=>'Meta actualizada correctamente:',
            'meta' => $metaoficina,
            'status' => 200
        ];
        return response()->json($data,200);
    }
    
    public function updatePartial(Request $request,$id)
    {
        $metaoficina = Metaoficina::find($id);

        if(!$metaoficina) {
            $data = [
                'message' => 'No se encontro el id',
                'status' => 400
            ];
            return response()->json($data,400);
        }

        $validator = Validator::make($request->all(), [
            'departamento_id',
            'titulo',
            'descripcion',
            'valor_objetivo',
            'unidad',
            'fecha_inicio',
            'fecha_fin',
            'estado'
        ]);

        if($validator -> fails()){
            $data = [
                'message' => 'Error en la validacion de los datos',
                'errors' => $validator->errors(),
                'status' => 400
            ];
            return response()->json($data,400);
        }

        if($request -> has('departamento_id')){
            $metaoficina -> departamento_id = $request->departamento_id;
        }
        if($request -> has('titulo')){
            $metaoficina -> titulo = $request->titulo;
        }
        if($request -> has('descripcion')){
            $metaoficina -> descripcion = $request->descripcion;
        }
        if($request -> has('valor_objetivo')){
            $metaoficina -> valor_objetivo = $request->valor_objetivo;
        }
        if($request -> has('unidad')){
            $metaoficina -> unidad = $request->unidad;
        }
        if($request -> has('fecha_inicio')){
            $metaoficina -> fecha_inicio = $request->fecha_inicio;
        }
        if($request -> has('fecha_fin')){
            $metaoficina -> fecha_fin = $request->fecha_fin;
        }
        if($request -> has('estado')){
            $metaoficina -> estado = $request->estado;
        }

        $metaoficina->save();

        $data = [
            'message' => 'Meta actualizada',
            'meta' => $metaoficina,
            'status' => 200
        ];
        return response()->json($data,200);
    }
}
