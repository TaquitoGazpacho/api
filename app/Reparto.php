<?php
namespace App\Models;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Contracts\Auth\CanResetPassword;

class User extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'surname', 'phone', 'sex', 'email', 'password', 'image', 'email_token', 'suscripcion_id', 'oficina_id', 'verified',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    public function reparto()
    {
        return $this->hasMany('App\Models\Reparto');
    }

    public function suscripcion()
    {
        return $this->belongsTo('App\Models\Suscripcion');
    }
    public function oficina()
    {
        return $this->belongsTo('App\Models\Oficina');
    }
    public function changeImage($image){
        User::where('id', $this->id)
            ->update(['image' => 'img/userImg/'.$image]);
    }
    public function cambiarOficina($office_id){
        User::where('id', $this->id)
            ->update(['oficina_id'=>$office_id]);
    }
    public function isVerified(){
        return $this->verified;
    }
    public static function getUsuarios(){
        return User::get();
    }
}
