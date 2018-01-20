<?php

namespace App\Http\Controllers;

use App\Peticion;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class PeticionController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        if($request->header("peticion")== "codigoRepartidor"){

            try{
                $peticion = new Peticion();
                $peticion->setCodigoRepartidor($this->generarCodigo());
                $peticion->setCodigoUsuario($this->generarCodigo());

                $peticion->save();
                return response()->json(['status'=>true,'codigoRepartidor'=>$peticion->codigoRepartidor],200);
            }catch (\Exception $e){
                Log::critical("No se hacer la peticion: {$e->getMessage()}");
            }
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
       $peticion= Peticion::find($id);
       return response()->json($peticion);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
    public function generarCodigo(){
        $codigo = '';
        $caracteres = '1234567890';
        $max = strlen($caracteres)-1;
        for($i=0;$i < 6;$i++) $codigo .= $caracteres{mt_rand(0,$max)};
        return $codigo;
    }
}
