<?php
namespace Org\Util;
use Org\Util\Curl;

class WeiXin {
    private static $ACCESS_TOKEN;

    public function __construct($app){
        self::$ACCESS_TOKEN = $this->getAccessToken($app);
    }

    /**
     * 获取自定义菜单(微信服务器上的)
     * @return string url
     */
    public function getMenu(){
        $url = 'https://api.weixin.qq.com/cgi-bin/menu/get?access_token=' . self::$ACCESS_TOKEN;
        return file_get_contents($url);
    }

    /**
     * 创建自定义菜单
     */
    public static function createMenu($data){
        $url = "https://api.weixin.qq.com/cgi-bin/menu/create?access_token=" . self::$ACCESS_TOKEN;
        $ch = new Curl();
        $ch->createData($data);
        $ch->createCurl();
        return $ch->result;
    }

    /**
     * 删除自定义菜单
     */
    public static function deleteMenu(){
        $url = "https://api.weixin.qq.com/cgi-bin/menu/delete?access_token=" . self::$ACCESS_TOKEN;
        $restlt = file_get_contents($url);
        return $restlt;
    }

    /**
     * 获取access_token
     * @param array app
     * @return string access_token
     */
    public function getAccessToken($app){
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

    public function __destruct(){
        self::$ACCESS_TOKEN = null;
    }
}