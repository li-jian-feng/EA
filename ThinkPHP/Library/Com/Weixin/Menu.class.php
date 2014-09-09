<?php
namespace Com\Weixin;
class Menu extends Weixin {

    /**
     * 获取自定义菜单(微信服务器上的)
     * @return string
     */
    public function getMenu(){
        $url = $this->url . 'menu/get?access_token=' . $this->ACCESS_TOKEN;
        return file_get_contents($url);
    }

    /**
     * 创建自定义菜单
     * @param array data
     */
    public function createMenu($data){
        $url = $this->url . 'menu/create?access_token=' . $this->ACCESS_TOKEN;
        $this->ch->createData(arr2json(array('button'=>$data)));
        return $this->ch->execute($url, 'POST');
    }

    /**
     * 删除自定义菜单
     */
    public function deleteMenu(){
        $url = $this->url . 'menu/delete?access_token=' . $this->ACCESS_TOKEN;
        $restlt = file_get_contents($url);
        return $restlt;
    }
}