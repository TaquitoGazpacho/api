<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Oficina extends Model
{

    protected $fillable = [
        'pais','ciudad', 'calle', 'num_calle', 'cp', 'lat', 'alt'
    ];

    public function __construct(){
        $this->pais="";
        $this->ciudad="";
        $this->calle="";
        $this->num_calle="";
        $this->cp="";
        $this->alt=0;
        $this->lat=0;
    }

    public function setId($id){
        $this->id=$id;
    }

    public function setPais($pais){
        $this->pais=$pais;
    }

    public function getPais(){
        return $this->pais;
    }

    public function setCp($cp){
        $this->cp=$cp;
    }

    public function getCP(){
        return $this->cp;
    }

    public function setLat($lat){
        $this->lat=$lat;
    }

    public function getLat(){
        return $this->lat;
    }

    public function setAlt($alt){
        $this->alt=$alt;
    }

    public function getAlt(){
        return $this->alt;
    }

    public function getCiudad(){
        return $this->ciudad;
    }

    public function setCiudad($ciudad){
        $this->ciudad=$ciudad;
    }

    public function getCalle(){
        return $this->calle;
    }

    public function setCalle($calle){
        $this->calle=$calle;
    }

    public function getNumCalle(){
        return $this->num_calle;
    }

    public function setNumCalle($num_calle){
        $this->num_calle=$num_calle;
    }

    public function getOficina($id){
        $office=Oficina::where('id', $id)->first();
        $this->id =$id;
        $this->setPais($office->pais);
        $this->setCiudad($office->ciudad);
        $this->setCalle($office->calle);
        $this->setNumCalle($office->num_calle);
        $this->setCp($office->cp);
        $this->setAlt($office->alt);
        $this->setLat($office->lat);
    }

    public function taquilla()
    {
        return $this->hasMany('App\Models\Taquilla');
    }

    public function user()
    {
        return $this->hasMany('App\Models\User');
    }

    public function reparto()
    {
        return $this->hasMany('App\Models\Reparto');
    }

    public static function getOficinas()
    {
        $oficinas = DB::table('oficinas')->select('id', 'pais', 'ciudad', 'calle', 'num_calle', 'cp', 'alt', 'lat')->orderBy('pais', 'asc')->orderBy('ciudad', 'asc')->get();
        return $oficinas;
    }
}
