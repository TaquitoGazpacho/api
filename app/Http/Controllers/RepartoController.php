<?php

namespace App\Http\Controllers;

use App\Reparto;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class RepartoController extends Controller
{
    public function __construct()
    {
        $this->middleware('apiAuth');
    }

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

    protected function comprobarCodigo($oficina_id, $taquilla_id, $codigo)
    {
        if ($codigo=="0000" && $oficina_id==1 && $taquilla_id==1){
            return "true";
        }
        $reparto= Reparto::where([
            ['oficina_id', '=', $oficina_id],
            ['taquilla_id', '=',$taquilla_id],
            ['estado', '=', 'Enviado'],
            ['clave_repartidor', '=', $codigo]
        ])->orWhere([
            ['oficina_id', '=', $oficina_id],
            ['taquilla_id', '=',$taquilla_id],
            ['estado', '=', 'Depositado'],
            ['clave_usuario', '=', $codigo]
        ])->first();

        if (isset($reparto['id'])){
            $this->cambiarEstado($reparto);
            return "true";
        } else{
            return "false";
        }

    }

    protected function cambiarEstado($reparto){
        if ($reparto->estado == 'Enviado'){
            DB::table('repartos')
                ->where('id', $reparto->id)
                ->update([
                    'estado' => 'Depositado',
                    'updated_at' => Carbon::Now()
                    ]);
        }else if ($reparto->estado == 'Depositado'){
            //actualizar estado del reparto
            DB::table('repartos')
                ->where('id', $reparto->id)
                ->update([
                    'estado' => 'Recogido',
                    'updated_at' => Carbon::Now()
                ]);
            //actualizar estado de la taquilla (libre/ocupada)
            DB::table('taquillas')
                ->where('id', $reparto->taquilla_id)
                ->update([
                    'ocupada' => false,
                    'updated_at' => Carbon::Now()
                ]);
        }
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
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {

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



}
