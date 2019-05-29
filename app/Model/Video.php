<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Validator;

class Video extends Model
{
    protected $table = 'video';

    public $timestamps = false;
    protected $fillable = ['catid', 'description', 'thumb','video','is_show','userid','isadmin','pv','created_at','updated_at'];

    //查询index页面12视频mobile通用
    public static function getShowVideo(){
        return  self::join('user_doc', 'video.userid', '=', 'user_doc.doc_id')
            ->join('category', 'video.catid','=', 'category.id')
            ->where('is_show', 1)
            ->where('status', 'FINISH')
            ->select('catname','video.id', 'video.is_admin','video.description', 'video.catid','video.thumb','video.video','video.userid','video.pv','video.created_at','user_doc.doc_name','user_doc.profess','user_doc.summary')
            ->paginate(12);
    }
    //按照分类查询
    public static function getCatVideo($catid){
        return  self::join('user_doc', 'video.userid', '=', 'user_doc.doc_id')
            ->join('category', 'video.catid','=', 'category.id')
            ->where('is_show', 1)
            ->where('status', 'FINISH')
            ->where('video.catid', $catid)
            ->select('status','video.is_show','video.is_admin','catname','video.id', 'video.description', 'video.catid','video.thumb','video.video','video.userid','video.pv','video.created_at','user_doc.doc_name','user_doc.profess','user_doc.summary')
            ->orderBy('video.created_at','desc')
            ->paginate(8);
    }
    //根据视频id查询
    public static function getVideoById($id){
        return  self::join('user_doc', 'video.userid', '=', 'user_doc.doc_id')
            ->join('category', 'video.catid','=', 'category.id')
            ->where('video.id', $id)
            ->select('status','video.is_show','video.is_admin','catname','video.id', 'video.description', 'video.catid','video.thumb','video.video','video.userid','video.pv','video.created_at','user_doc.doc_name','user_doc.profess','user_doc.summary')
            ->first();
    }
    //查询pc相关视频
    public static function getVideoAbout($catid , $id, $num = 2){
        return  self::join('user_doc', 'video.userid', '=', 'user_doc.doc_id')
            ->where('video.id','!=',$id)
            ->where('catid', $catid)
            ->select('video.id', 'video.description', 'video.catid','video.thumb','video.video','video.userid','video.pv','video.created_at','user_doc.doc_name','user_doc.profess','user_doc.summary')
            ->take($num)
            ->get();
    }
    //查询所有医生所属视频
    public static function getUserDocVideo($doc_id){
        return  self::join('category', 'video.catid','=', 'category.id')
                ->join('user_doc', 'video.userid', '=', 'user_doc.doc_id')
                ->where('userid','=',$doc_id)
                ->select('status','video.is_show','video.is_admin','catname','video.id', 'video.description', 'video.catid','video.thumb','video.video','video.userid','video.pv','video.created_at','user_doc.doc_name','user_doc.profess','user_doc.summary')
                ->paginate(12);
    }
    //视频名称搜索
    public static function getVideoSearch($search_content){
        return  self::join('user_doc', 'video.userid', '=', 'user_doc.doc_id')
            ->join('category', 'video.catid','=', 'category.id')
            ->where('is_show', 1)
            ->where('status', 'FINISH')
            ->where('description','like', '%'.$search_content.'%')
            ->select('catname','video.id', 'video.description', 'video.catid','video.thumb','video.video','video.userid','video.pv','video.created_at','user_doc.doc_name','user_doc.profess','user_doc.summary')
            ->paginate(12);
    }
    //后台查询所有视频
    public static function getVideoAll(){
        return  self::orderBy('created_at', 'desc')
            ->join('category', 'video.catid','=', 'category.id')
            ->select('catname','video.id','video.status','video.description', 'video.catid','video.thumb','video.video','video.userid','video.pv','video.created_at')
            ->paginate(12);
    }
    //观看视频添加点击量
    public static function addVideoPv($id){
        return  self::where('id',$id)->increment('pv',1);
    }
    //后台添加视频
    public static function addVideo($input, $video){
        empty($input['is_show'])? $input['is_show'] = '0':$input['is_show'] = '1';
        empty($input['is_admin'])? $input['is_admin'] = '0':$input['is_admin'] = '1';
        empty($input['status'])? $input['status'] = 'READY':$input['status'] = 'FINISH';
        $input['created_at'] = date('Y-m-d H:i:s');
        $input['updated_at'] = date('Y-m-d H:i:s');
        $input['video'] = $video;
        return self::insert($input);
    }
    //后台修改视频
    public static function editVideo($input){
        empty($input['is_show'])? $input['is_show'] = '0':$input['is_show'] = '1';
        empty($input['is_admin'])? $input['is_admin'] = '0':$input['is_admin'] = '1';
        empty($input['status'])? $input['status'] = 'READY':$input['status'] = 'FINISH';
        return self::where('id',$input['id'])->update([
            'description'=>$input['description'],
            'catid'=>$input['catid'],
            'thumb'=>$input['thumb'],
            'video'=>$input['video'],
            'is_show'=>$input['is_show'],
            'userid'=>$input['userid'],
            'is_admin'=>$input['is_admin'],
            'status'=>$input['status'],
            'pv'=>$input['pv'],
            'updated_at'=>date('Y-m-d H:i:s',time()),
        ]);
    }
    public static function  getCollectByVideoId($aVideo){
        return  self::where('is_show', 1)
            ->where('status', 'FINISH')
            ->join('user_doc', 'video.userid', '=', 'user_doc.doc_id')
            ->join('category', 'video.catid','=', 'category.id')
            ->whereIn('video.id',$aVideo)
            ->select('catname','video.id', 'video.description', 'video.catid','video.thumb','video.video','video.userid','video.pv','video.created_at','user_doc.doc_name','user_doc.profess','user_doc.summary')
            ->get();
    }
    public static function  loadingMore($page, $size, $catid){
        return  self::join('user_doc', 'video.userid', '=', 'user_doc.doc_id')
            ->join('category', 'video.catid','=', 'category.id')
            ->where('is_show', 1)
            ->where('status', 'FINISH')
            ->where('video.catid', $catid)
            ->select('catname','video.id', 'video.description', 'video.catid','video.thumb','video.video','video.userid','video.pv','video.created_at','user_doc.doc_name','user_doc.profess','user_doc.summary')
            ->orderBy('video.created_at','desc')
            ->skip(($page - 1) * $size)
            ->take($size)
            ->get();
    }

    public static function addValidate($input = null)
    {
        return Validator::make($input, [
        'description' => 'required',
        'catid' => 'required',
        'thumb' => 'required',
        'video' => 'required',
        'userid' => 'required',
        'pv' => 'required',

    ], [
        'required' => ':attribute为必填项',
    ], [
        'description' => '视频描述',
        'catid' => '视频类型',
        'pv' => '视频pv',
        'thumb' => '图片',
        'video' => '视频',
        'userid' => '医生',
    ]);
    }
}
