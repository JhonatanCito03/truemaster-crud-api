<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Empleado;
use Illuminate\Support\Facades\Validator;

class empleadoController extends Controller
{
    public function index()
    {
        $empleado = Empleado::all();

        //if ($empleado->isEmpty()){
        //    $data = [
        //        'message' => 'No hay empleados creados',
        //        'status' => 200
        //    ];
        //    return response()->json($data, 404);
        //};

        $data = [
            'empleado' => $empleado,
            'status' => 200
        ];
        return response()->json($data, 200);
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(),[
        'name' => 'required|max:255',
        'age' => 'required|max:255',
        'email' => 'required|email|unique:empleado',
        'globalScore' => 'required|max:4',
        'phone' => 'required|max:12',
        'password' => 'required',
        'rol' => 'required|max:255',
        'id_number' => 'max: 25|unique:empleado',
        'img' => 'required|max:255',
        'region' => 'required|max:255',
        ]);

        if($validator->fails()){
            $data = [
                'message' => 'Error en la validacion de los datos',
                'errors' => $validator->errors(),
                'status'=>400
            ];
            return response() ->json($data,400);
        }

        $empleado = Empleado::create([
            'name' => $request->name,
            'age' => $request->age,
            'email' => $request->email,
            'globalScore' => $request->globalScore,
            'phone' => $request->phone,
            'password' => $request->password,
            'rol' => $request->rol,
            'id_number' => $request->id_number,
            'img' => $request->img,
            'region' => $request->region,
        ]);

        if(!$empleado) {
            $data = [
                'message' => 'Error en la validacion de los datos',
                'errors' => $validator->errors(),
                'status'=>500
            ];
            return response() ->json($data,500);
        }

        $data = [
            'empleado' => $empleado,
            'status' => 201
        ];
        return response()->json($data, 201);
    }

    public function show($id){
        $empleado = Empleado::find($id);

        if(!$empleado){
            $data = [
                'message' => 'Empleado no encontrado',
                'satus' => 404
            ];
            return response() -> json($data, 404);
        }
        $data = [
            'empleado' => $empleado,
            'status' => 200
        ];
        return response()->json($data,200);
    }

    public function delete($id){
        $empleado = empleado::find($id);

        if(!$empleado){
            $data = [
                'message' => 'Estudiante no encontrado',
                'status' => 404
            ];
            return response()->json($data,404);
        }

        $empleado -> delete();

        $data = [
            'message' => 'Estudiante eliminado',
            'status' => 200
        ];
        return response()->json($data,200);
    }
    public function update(Request $request, $id){
        $empleado = Empleado::find($id);

        if(!$empleado){
            $data = [
                'message' => 'Empleado no encontrado',
                'status' => 404
            ];
            return response()->json($data,404);
        }

        $validator = validator::make($request->all(),[
        'name' => 'required|max:255',
        'age' => 'required|max:4',
        'email' => 'required|email|unique:empleado',
        'globalScore' => 'required|max:4',
        'phone' => 'required|max:12',
        'password' => 'required',
        'rol' => 'required|max:255',
        'id_number' => 'max: 25|unique:empleado',
        'img' => 'required|max:255',
        'region' => 'required|max:255',
        ]);

        if($validator ->fails()){
            $data = [
                'message' => 'Error en la validacion de los datos',
                'errors' => $validator->errors(),
                'status' => 400
            ];
            return response()->json($data,404);
        }

        $empleado->name = $request->name;
        $empleado->age = $request->age;
        $empleado->email = $request->email;
        $empleado->globalScore = $request->globalScore;
        $empleado->phone = $request->phone;
        $empleado->password = $request->password;
        $empleado->rol = $request->rol;
        $empleado->img = $request->img;
        $empleado->region = $request->region;
        $empleado->save();

        $data = [
            'message' => 'Empleado actualizado',
            'empleado' => $empleado,
            'status' => 200
        ];
        return response()->json($data,200);
    }

    public function updatePartial(Request $request, $id){
        $empleado = Empleado::find($id);

        if(!$empleado){
            $data = [
                'message' => 'Empleado no encontrado',
                'status' => 404
            ];
            return response()->json($data,404);
        }

        $validator = validator::make($request->all(),[
        'name' => 'max:255',
        'age' => 'max:4',
        'email' => 'email|unique:empleado',
        'globalScore' => 'max:4',
        'phone' => 'max:15',
        'password' => '',
        'rol' => 'max:255',
        'id_number' => 'max: 25|unique:empleado',
        'img' => 'max:255',
        'region' => 'max:255',
        ]);

        if($validator ->fails()){
            $data = [
                'message' => 'Error en la validacion de los datos',
                'errors' => $validator->errors(),
                'status' => 400
            ];
            return response()->json($data,404);
        }

        if($request->has('name')){
            $empleado->name = $request->name;
        }
        if($request->has('age')){
            $empleado->age = $request->age;
        }
        if($request->has('email')){
            $empleado->email = $request->email;
        }
        if($request->has('globalScore')){
            $empleado->globalScore = $request->globalScore;
        }
        if($request->has('phone')){
            $empleado->phone = $request->phone;
        }
        if($request->has('password')){
            $empleado->password = $request->password;
        }
        if($request->has('rol')){
            $empleado->rol = $request->rol;
        }
        if($request->has('message')){
            $empleado->message = $request->message;
        }
        if($request->has('img')){
            $empleado->img = $request->img;
        }
        if($request->has('region')){
            $empleado->region = $request->region;
        }
        $empleado->save();

        $data = [
            'message' => 'Empleado actualizado',
            'empleado' => $empleado,
            'status' => 200
        ];
        return response()->json($data,200);
    }
}
