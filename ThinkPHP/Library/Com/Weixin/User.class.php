<?php
namespace Com\Weixin;
class User extends Weixin {

    /**
     * 设置用户备注名
     * @param string openid
     * @param string remark
     */
    public function updateRemark($openid, $remark){
        $url = $this->url . 'user/info/updateremark?access_token=' . $this->ACCESS_TOKEN;
        $data = '{"openid":"' . $openid . '","remark":"' . $remark . '"}';
        $this->ch->createData($data);
        return $this->ch->execute($url, 'POST');
    }

    /**
     * 获取用户基本信息(UnionID机制)
     * @param string openid
     */
    public function userInfo($openid){
        $url = $this->url . 'user/info?access_token=' . $this->ACCESS_TOKEN . '&openid=' . $openid . '&lang=zh_CN';
        return file_get_contents($url);
    }

    /**
     * 获取关注者列表<p> 第一个拉取的OPENID，不填默认从头开始拉取 </p>
     * @param string next_openid
     */
    public function getUsers($next_openid = ''){
        $url = $this->url . 'user/get?access_token=' . $this->ACCESS_TOKEN;
        if($next_openid){
            $url .= '&next_openid=' . $next_openid;
        }
        return file_get_contents($url);
    }

    /**
     * 获取用户地理位置
     */
    public function a(){}

    /**
     * 网页授权获取用户基本信息
     */
    public function auth(){
        
    }
}