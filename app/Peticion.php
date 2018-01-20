<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Peticion extends Model
{

    protected $table="peticiones";
    protected $fillable=['codigoRepartidor','codigoUsuario'];
    protected $hidden=['id','created_at','updated_at'];

    public function __construct(){
        $this->codigoUsuario="";
        $this->codigoRepartidor="";

    }

    public function setCodigoUsuario($codigo)
    {
        $this->codigoUsuario = $codigo;
    }

    public function setCodigoRepartidor($codigo)
    {
        $this->codigoRepartidor = $codigo;
    }


}
