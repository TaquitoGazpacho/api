<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Reparto extends Model
{
    protected $fillable = [
        'clave_repartidor', 'clave_usuario', 'usuario_id','empresa_id', 'oficina_id', 'taquilla_id',
    ];

    public static function getRepartos() {
        $empresa_id = Auth::guard('empresa')->user()->id;

        $repartos = Reparto::where('empresa_id', $empresa_id)->get();


        return $repartos;
    }

    public function usuario()
    {
        return $this->belongsTo('App\User');
    }

    public function empresa()
    {
        return $this->belongsTo('App\Empresa_reparto');
    }

    public function oficina()
    {
        return $this->belongsTo('App\Oficina');
    }

    public function taquilla()
    {
        return $this->belongsTo('App\Taquilla');
    }
}
