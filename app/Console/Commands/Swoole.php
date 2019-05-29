<?php

namespace App\Console\Commands;

use App\Model\Black_user;
use App\Model\Danmu;
use App\Model\Live_time;
use App\Services\ComService;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Redis;

class Swoole extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'swoole:action {action}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'swoole command';


//    public function __construct(Message $message, User $user, RoomJoin $room)
//    {
//        parent::__construct();
//        $this->message = $message;
//        $this->user = $user;
//        $this->room = $room;
//    }


    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        $action = $this->argument('action');
        switch ($action) {
            case 'start':
                $this->start();
                break;
            case 'stop':
                $this->stop();
                break;
            case 'restart':
                $this->restart();
                break;
        }
    }

    /**
     * 开启websocket   php artisan swoole:action start
     */
    private function start()
    {
        $ws = new \swoole_websocket_server(config('swoole.host'), config('swoole.port'));
        $ws->set(
            array(
                'heartbeat_check_interval' => 5,
                'heartbeat_idle_time' => 10,
            )
        );
        $ws->on('open', function ($ws, $request) {
            $message = '欢迎来到直播间,请文明用语';
            $message = json_encode([
                'message' => $message,
                'type' => 'open',
                'userid' => '0000',
                'username' => 'H学院'
            ]);
            $ws->push($request->fd, $message);
        });

        //监听WebSocket消息事件
        $ws->on('message', function ($ws, $frame) {
            $data = json_decode($frame->data, true);

            switch ($data['type']) {
                case 'connect':
                     $key = "live:".$data['live_id'] . ":" . addslashes($data['userid']);
                     $res = Redis::exists($key);
                     if($res){
                         $message = '您已有账号登录此直播间，请退出账号后重进此页面';
                         $message = json_encode([
                             'message' => $message,
                             'type' => 'dis_con',
                             'userid' => '0000',
                             'username' => 'H学院'
                         ]);
                         $ws->push($frame->fd, $message);
                     }else{
                         Redis::set($key, $frame->fd);
                         $key_client = 'client:'.$frame->fd ;
                         Redis::set($key_client, $key);
                         //插入播放开始时间
                         Live_time::addSTime($data['userid'],$data['live_id'],$data['user_agent']);
                     }
                    break;
                case 'message':
                    $key = "black_user:" . addslashes($data['userid']);
                    $res = Redis::exists($key);
                    if($res){
                        $message = json_encode([
                            'message' => '您的账号暂时不能发言',
                            'type' => 'message',
                            'userid' => '0000',
                            'username' => 'H学院',
                        ]);
                        $ws->push($frame->fd ,$message);
                        break;
                    }else{
                        Danmu::addDanmu($data);
                        self::sendAll($ws,$frame->fd, $data['live_id'], $data['userid'], $data['username'],$data['danmu']);
                    }
                    break;
                case 'close':
                    $key = "live:".$data['live_id'] . ":" . addslashes($data['userid']);
                    $key_client = 'client:'.$frame->fd ;
                    Redis::del(addslashes($key));
                    Redis::del(addslashes($key_client));
                    break;
                case 'heart':
                    $message = json_encode([
                        'message' => $frame->fd.'连接中',
                        'type' => 'is_conn',
                        'userid' => '0000'
                    ]);
                    $ws->push($frame->fd ,$message);
                    break;
                default:
                    break;
            }

        });

        $ws->on('close', function ($ws, $fd) {
            // 通过客户端id，查找liveid
            $key = 'client:'.$fd ;
            $key_client = Redis::get($key);
            $userid = substr($key_client,strripos($key_client,":")+1);
            $live_id_and_userid = substr($key_client,5,strrpos($key_client,":"));
            $live_id = substr($live_id_and_userid,0,strrpos($live_id_and_userid,":"));
            Live_time::editETime($userid, $live_id);
            Redis::del($key);
            Redis::del($key_client);

        });

        $ws->start();
    }
    private function sendAll($ws,$fd, $live_id, $userid = null,$username, $message = null, $type = 'message')
    {
        $message = json_encode([
            'message' => is_string($message) ? nl2br($message) : $message,
            'type' => $type,
            'userid' => $userid,
            'username' => $username
        ]);
        $key = "live:" . $live_id . ":*";
        $keys = Redis::keys($key);
        $members = array();
        foreach ($keys as $key) {
            $members[] = Redis::get($key);
        }
        foreach ($members as $fd) {
            $ws->push($fd, $message);
        }
    }

    /**
     * 重启
     */
    private function restart()
    {
//        lsof -i:9567
        Log::info('正在重启swoole');
        $cmd = 'kill -USR1 '.'11559';
        shell_exec($cmd);
        Log::info('重启swoole完成');
    }
}
