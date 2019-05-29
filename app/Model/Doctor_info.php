<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class Doctor_info extends Model
{
    protected $table = 'doctor_info';


    protected $fillable = ['name', 'sex', 'carclass','cat','no','company','major','upstream','province','url','cddi_datetime'];

    public static function checkDoctorInfo($name , $no){
        return self::where('name', $name)
            ->where('no',$no)
            ->first();
    }


}
