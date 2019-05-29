<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class Ad extends Model
{
    protected $table = 'ad';


    protected $fillable = ['id','title', 'photo','position','url','updated_at','created_at'];

    public static function getAdAll(){
        return self::orderBy('created_at', 'desc')
            ->paginate(10);
    }
    public static function getAdById($id){
         return  self::where('id', $id)->first();
    }
    public static function editAdById($input){
        return self::where('id',$input['id'])->update([
            'title'=>$input['title'],
            'position'=>$input['position'],
            'photo'=>$input['photo'],
            'url'=>$input['url'],
            'updated_at'=>date('Y-m-d H:i:s',time()),
        ]);
    }
    public static function getAdByPosition($position){
        return  self::where('position', $position)->first();
    }

}
