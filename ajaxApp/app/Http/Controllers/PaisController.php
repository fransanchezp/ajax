<?php

namespace App\Http\Controllers;
use App\Models\Pais;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class PaisController extends Controller
{
    //
    function index(){
        $paises = Pais::all();
        return response()->json(['paises' => $paises]);
    } 
    
    function store(Request $request) {
            //validar
            $validator = Validator::make($request->all(), [
                'code' => 'required|max:3|min:3|unique:pais,code',
                'name' => 'required|max:100|unique:pais,name',
            ]);
            /*if($validator->passes()) {
                
            }*/
            if($validator->fails()) {
                $respuesta = ['result' => -1, 'message' => $validator->getMessageBag()];
            } else {
                try {
                    $pais = new Pais($request->all());
                    $pais->save();
                    $respuesta = [
                                    'result' => 1, 
                                    'message' => 'Pais insertado correctamente.',
                                    'paises' => Pais::all()
                                ];
                } catch(\Exception $e) {
                    $respuesta = ['result' => -2, 'message' => $e];
                }
            }
            //intentar insertar
            return response()->json($respuesta);
        }
        
    function update(Request $request, $code ){
        $pais = Pais::find($code);
        //$rules['nombre'] = 'required|string|min:3|max:60|unique:producto,nombre'. $this->producto->id;
        $validator = Validator::make($request->all(), [
            'code' => 'required|max:3|min:3',
            'name' => 'required|max:100',
            ]);
            if($validator->fails()) {
                $respuesta = ['result' => -1, 'message' => $validator->getMessageBag()];
            } else {
                try {
                    $pais->update($request->all());
                    $respuesta = [
                                    'result' => 1, 
                                    'message' => 'Pais editado correctamente.',
                                    'paises' => Pais::all()
                                ];
                } catch(\Exception $e) {
                    $respuesta = ['result' => -2, 'message' => $e];
                }
             return response()->json($respuesta);
            }
        //HAY QUE CONTROLAR LOS NULL
    }
    
    function show(Request $request, $code){
        sleep(1);
        $pais = Pais::find($code);
        return response()->json(['pais' => $pais]);
        //HAY QUE CONTROLAR LOS NULL
    }
    
     public function destroy($code) {
     try {
         
          $pais = Pais::find($code);
        
        try {
            $pais->delete();
            $respuesta = [
               'result' => 1, 
               'message' => 'Pais editado correctamente.',
               'paises' => Pais::all()
                        ];
        return response()->json($respuesta);
    } catch (\Exception $e) {
        return response()->json(['result' => 0, 'error' => $e->getMessage()]);
    }
        } catch(\Exception $e) {
            return back()->withErrors(['message' => 'The pais has not been deleted.']);

        }
        
  
    }
    
    
}