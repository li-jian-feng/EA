<?php
namespace Weixin\Controller;
use Com\Weixin\User;

class UserController extends WeixinController {
    private $User;

    public function _initialize(){
        parent::_initialize();
        $this->User = new User();
    }

    public function index(){
        $User = D('User')->where('user_id = ' . session('user_id'))->select();
        $this->display();
    }

    public function group(){}
}