<?php

namespace App\Http\Controllers;

use App\Peticion;
use App\Reparto;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class PeticionController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $idOficina= $request['idOf'];
        $idTaquilla= $request['idTaq'];
        $codigo= $request['codigo'];
        return $this->comprobarCodigo($idOficina,$idTaquilla,$codigo);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $peticion = new Peticion();
        $peticion->setCodigoRepartidor($this->generarCodigo());
        $peticion->setCodigoUsuario($this->generarCodigo());
        return $peticion;
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
                $peticion = $this->create();
                $peticion->save();
                return response()->json(['status'=>true,'codigoRepartidor'=>$peticion->codigoRepartidor,'idPeticion'=>$peticion->id],200);
            }catch (\Exception $e){
                Log::critical("No se hacer la peticion: {$e->getMessage()}");
            }
        }elseif (($request->header("idPeticion"))){

            $codigoUsuario = ($this->show($request->header("idPeticion")))->codigoUsuario;
            return response()->json(['status' => true, 'codigoUsuario' => $codigoUsuario],200);
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
       return view('welcome')->with('pet',$peticion);
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

    protected function comprobarCodigo($oficina_id, $taquilla_id, $codigo)
    {
        $reparto= Reparto::where([
            ['oficina_id', '=', $oficina_id],
            ['taquilla_id', '=',$taquilla_id],
            ['clave_repartidor', '=', $codigo]
        ])->orWhere([
            ['oficina_id', '=', $oficina_id],
            ['taquilla_id', '=',$taquilla_id],
            ['clave_usuario', '=', $codigo]
        ])->first();

        if (isset($reparto['id'])){
            return "true";
        } else{
            return "false";
        }

    }
}
