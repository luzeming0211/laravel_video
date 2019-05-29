<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class Danmu extends Model
{
    protected $table = 'danmu';


    protected $fillable = ['content', 'userid','username','live_id','created_at','updated_at'];

    public static function  addDanmu($data){
        $input['live_id'] = $data['live_id'];
        $input['userid'] = $data['userid'];
        $input['username'] = $data['username'];
        $input['danmu'] = $data['danmu'];
        $input['created_at'] = date('Y-m-d H:i:s');
        $input['updated_at'] = date('Y-m-d H:i:s');
        return self::insert($input);
    }


}
