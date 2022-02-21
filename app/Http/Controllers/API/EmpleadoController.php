<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Empleado;

class EmpleadoController extends Controller
{
    public function index(){
        $empleados = Empleado::all();
        return response()->json(
            [
                'status'=> 200,
                'empleados'=>$empleados,
            ]);
    }
    public function store(Request $request){

        $validator = Validator::make($request->all(),[
            'nombre'=>'required|max:191',
            'apellidopaterno'=>'required|max:191',
            'apellidomaterno'=>'required|max:191',
            'correo'=>'required|email|max:191',
        ] 
        );
        if($validator->fails()){
            return response()->json(
                [
                    'validate_err'=> $validator->message(),
                ]);
        }
        else{

        $empleado = new Empleado;
        $empleado ->nombre =$request->input('nombre');
        $empleado ->apellidopaterno =$request->input('apellidopaterno');
        $empleado ->apellidomaterno =$request->input('apellidomaterno');
        $empleado ->correo =$request->input('correo');
        $empleado ->save();

        return response()->json(
            [
                'status'=> 200,
                'message'=>'Se ha añanido un nuevo empleado',
            ]);
            }
    }

    public function edit($id){
        $empleado = Empleado::find($id);
        if($empleado){
                  return response()->json([
            'status=>200',
            'empleado' => $empleado,
        ]);  
        }
        else{
            return response()->json([
                'status=>200',
                'message' => 'No Empleado ID Found',
            ]);
        }

    }

    public function update(Request $request, $id){
        $validator = Validator::make($request->all(),[
            'nombre'=>'required|max:191',
            'apellidopaterno'=>'required|max:191',
            'apellidomaterno'=>'required|max:191',
            'correo'=>'required|email|max:191',
        ] 
        );
        if($validator->fails()){
            return response()->json(
                [
                    'validate_err'=> $validator->message(),
                ]);
        }
        else{

                $empleado = Empleado::find($id);
                if($empleado)
                {

                
                        $empleado ->nombre =$request->input('nombre');
                        $empleado ->apellidopaterno =$request->input('apellidopaterno');
                        $empleado ->apellidomaterno =$request->input('apellidomaterno');
                        $empleado ->correo =$request->input('correo');
                        $empleado ->update();

                        return response()->json(
                        [
                            'status'=> 200,
                            'message'=>'Se ha actualizado correctamente',
                        ]);
                }
                else
                {
                    return response()->json([
                        'status=>200',
                        'message' => 'No Empleado ID Found',
                    ]);
                }
            }  
    }

    public function destroy($id){
        $empleado = Empleado::find($id);
        $empleado->delete();
        return response()->json(
            [
                'status'=> 200,
                'message'=>'Se ha eliminado correctamente',
            ]);
    }
}
