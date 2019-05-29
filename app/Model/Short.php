<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class Short extends Model
{
    protected $table = 'short';


    protected $fillable = ['id','video', 'pic','des','is_top','created_at','updated_at'];

    public static function getShortById($id){
        return  self::where('id', $id)->first();
    }
    public static function delMailByIdArray($id_array){
        return  self::whereIn('id', $id_array)->delete();
    }
    public static function getShortAll(){
        return self::orderBy('created_at', 'desc')
            ->paginate(10);
    }
    public static function getShortShow(){
        return self::orderBy('created_at', 'desc')
            ->paginate(10);
    }
    public static function getShortTop(){
        return self::where('is_top','Y')->orderBy('created_at', 'desc')->get();
    }
    public static function getShortNoTop(){
        return self::where('is_top','N')->orderBy('created_at', 'desc')
            ->paginate(5);
    }
    public static function editShort($input){
        return self::where('id',$input['id'])->update([
            'des'=>$input['des'],
            'pic'=>$input['photo'],
            'video'=>$input['video_edit'],
            'updated_at'=>date('Y-m-d H:i:s',time()),
        ]);
    }
    public static function editTopShort($id,$act){
        return self::where('id',$id)->update([
            'is_top'=>$act,
            'updated_at'=>date('Y-m-d H:i:s',time()),
        ]);
    }
    public static function addShort($input){
        $data['des'] = $input['des'];
        $data['pic'] = $input['thumb'];
        $data['video'] = $input['video_add'];
        $data['created_at'] = date('Y-m-d H:i:s');
        $data['updated_at'] = date('Y-m-d H:i:s');
        return self::insert($data);
    }
}
