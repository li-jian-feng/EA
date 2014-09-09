<?php
namespace Weixin\Model;
class MenuModel extends WeixinModel {
    protected $pk = 'id';
    // 自动完成 array(完成字段1,完成规则,[完成条件时间,附加规则])
    protected $_auto = array(array('user_id','get_user_id',self::MODEL_INSERT,'callback'));

    protected function get_user_id(){
        return session('user_id');
    }
    protected $_scope = array(
        'menu'=>array('order'=>'sort desc')
    );
}