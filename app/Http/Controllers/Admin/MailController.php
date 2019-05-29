<?php

namespace App\Http\Controllers\Admin;


use App\Http\Controllers\Controller;
use App\Model\Mail;
use Illuminate\Http\Request;

class MailController extends Controller
{
    public function getmail(){
        $mail =  Mail::getMailAll();
        return view('admin.mail',compact('mail'));
    }
    public function delMail(Request $request){
        if($request->ajax()) {
            $id_array = $request->input('id_array');
            $ret = Mail::delMailByIdArray($id_array);
            if($ret){
                return response()->json(['success' => true, 'msg' => '删除成功']);
            }
        }
    }

}