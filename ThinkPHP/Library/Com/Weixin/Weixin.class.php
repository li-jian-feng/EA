<?php
namespace Com\Weixin;
use Org\Util\Curl;

class Weixin {
    protected $ACCESS_TOKEN;
    protected $ch;
    protected $url = 'https://api.weixin.qq.com/cgi-bin/';

    public function __construct(){
        $this->ACCESS_TOKEN = $this->getAccessToken();
        $this->ch = new Curl();
    }

    /**
     * 获取access_token
     * @return string access_token
     */
    public function getAccessToken(){
        $app = $this->getWxApp();
        $M = M('access_token', 'wx_');
        $data = $M->cache('ac_token', 600)->where('user_id = ' . session('user_id'))->find();
        if(NOW_TIME < $data['end_time']){ // 如果数据表里存储的access_token时效未过
            return $data['access_token'];
        }else{
            $appid = $app['app_id'];
            $appsecret = $app['app_secret'];
            $url = "https://api.weixin.qq.com/cgi-bin/token?grant_type=client_credential&appid=$appid&secret=$appsecret";
            $result = json_decode(file_get_contents($url));
            $newField = array('access_token'=>$result->access_token,'end_time'=>NOW_TIME + 7200);
            $M->where('user_id = ' . session('user_id'))->setField($newField);
            S('ac_token', null);
            return $result->access_token;
        }
    }

    /**
     * 获取app_id,app_secret
     * @return array
     */
    public function getWxApp(){
        $app = D('Api')->where('user_id = ' . session('user_id'))->cache('wx_app', 600)->field('app_id,app_secret')->find();
        return $app;
    }
}