<?php

namespace App\Http\Controllers\Admin;


use App\Http\Controllers\Controller;
use App\Model\Sens;
use App\Model\Video_comment;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Storage;
use Maatwebsite\Excel\Facades\Excel;

class SensController extends Controller
{


    //敏感词列表
    public function getSens()
    {
        $sens = Sens::getSens();
        return view('admin.sens',['sens' => $sens]);
    }
    //删除敏感词
    public function del(Request $request)
    {
        if($request->ajax()) {
            $id_array = $request->input('id_array');
            $res = DB::table('sens')->whereIn('id', $id_array)->delete();
            if($res){
                return response()->json(['success' => true, 'msg' => '删除成功']);
            }
        }
    }
    public function upload_sens(Request $request)
    {
        $file = $request->file('file');
        if ($file->isValid()) {
            $ext = $file->getClientOriginalExtension();
            if(addslashes($ext) != 'xlsx'){
                $json = array('fail'=>true,'msg'=>'请上传正确的excel文件');
                echo json_encode($json);
                die;
            }
            $realPath = $file->getRealPath();   //临时文件的绝对路径
            $filename = date('Y-m-d-H-i-s') . '-' . uniqid() . '.' . $ext;
            Storage::disk('uploads')->put($filename, file_get_contents($realPath));
            $filePath = 'uploads/'.iconv('UTF-8', 'GBK', $filename);
            Excel::load($filePath,function ($reader){
                $reader = $reader->getSheet(0);
                $data = $reader->toArray();
                for($i=1;$i<count($data);$i++){
                    $sens = array(
                        'deny_word'=>$data[$i][0],
                        'deny_word_ext'=>$data[$i][1],
                    );
                    Sens::firstOrCreate($sens);
                }
                $json = array('success'=>true,'msg'=>'ok');
                echo json_encode($json);
                die;
            });
        }
    }
}