<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class Category extends Model
{


    protected $table = 'category';


    protected $fillable = ['catname'];
    //查询所有
    public static function getCatName(){
        return   self::get();
    }
    //查询4个
    public static function getCatNameFour(){
        return   self::get()->take(4);
    }
    //查询1个科室名
    public static function getCatNameById($catid){
        return   self::where('id', $catid)->first();
    }
}
