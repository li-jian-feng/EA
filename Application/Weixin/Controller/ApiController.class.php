<?php
namespace Weixin\Controller;
class ApiController extends WeixinController {

    public function index(){
        $data = D('Api')->where('user_id = ' . session('user_id'))->find();
        $this->assign('data', $data);
        $this->display();
    }

    public function doUpdate(){
        dump(I('param.'));
    }
}