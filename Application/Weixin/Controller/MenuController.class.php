<?php
namespace Weixin\Controller;
use Com\Weixin\Menu;

class MenuController extends WeixinController {
    private $Menu;

    public function _initialize(){
        parent::_initialize();
        $this->Menu = new Menu();
    }

    public function index(){
        $menu = D('Menu')->order('sort desc')->where('user_id = ' . session('user_id'))->select();
        $data = $this->getMenu($menu);
        $this->assign('menu', $data);
        $this->display();
    }

    private function getMenu($menu, $pid = 0){
        $arr = array();
        foreach($menu as $k => $v){
            unset($v['user_id']);
            if($v['pid'] == $pid){
                $v['sub_button'] = self::getMenu($menu, $v['id']);
                $arr[] = $v;
            }
        }
        return $arr;
    }

    public function doSave(){
        $Menu = D('Menu');
        if(! $Menu->create()){
            $this->returnStatus(false, $Menu->getError());
        }
        if(empty($Menu->id)){
            if($Menu->add()){
                $new_id = $Menu->getLastInsID();
                $data = $Menu->find($new_id);
                $this->returnStatus(true, '', json_encode($data));
            }
        }else{
            if($Menu->save()){
                $data = $Menu->find(I('post.id'));
                $this->returnStatus(true, '', json_encode($data));
            }
        }
    }

    public function doDelete(){
        $Menu = D('Menu');
        if(! $Menu->delete(I('get.id'))){
            $this->returnStatus(false);
        }
        $this->returnStatus();
    }

    public function doSaveToServer(){
        $menu = D('Menu')->scope('menu')->where('user_id = ' . session('user_id'))->select();
        $data = array_map('menu_format', $this->getMenu($menu));
        $status = $this->Menu->createMenu($data);
        $this->checkStatus($status, '已更新到微信服务器');
    }

    public function doDeleteToServer(){
        $status = $this->Menu->deleteMenu();
        $this->checkStatus($status, '自定义菜单关闭成功');
    }
}