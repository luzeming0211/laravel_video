<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class Black_user extends Model
{
    protected $table = 'black_user';


    protected $fillable = ['id','userid', 'reason','updated_at','created_at'];
    public static function isBlackUser($userid){
        return   self::where('userid', $userid)
            ->orderBy('created_at','desc')
            ->first();
    }
    public static function getBlackUserAll(){
        return   self::orderBy('created_at','desc')
            ->paginate(12);
    }
    public static function delBlackUserByIdArray($id_array){
        return  self::whereIn('userid', $id_array)->delete();
    }
    public  static  function editBlackUser($userid, $reason){
        return self::where('userid',$userid)->update([
            'reason'=>$reason,
            'num'=>2,
            'updated_at'=>date('Y-m-d H:i:s',time()),
        ]);
    }
    public  static  function addBlackTmpUser($userid, $reason){
        $data['userid'] = $userid;
        $data['reason'] = $reason;
        $data['num'] = 1;
        $data['created_at'] = date('Y-m-d H:i:s');
        $data['updated_at'] = date('Y-m-d H:i:s');
        return  self::insert($data);
    }
}
