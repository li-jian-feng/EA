<?php
namespace Weixin\Model;
class ApiModel extends WeixinModel {
    // 自动完成 array(完成字段1,完成规则,[完成条件时间,附加规则])
    protected $_auto = array(array('url','guid',self::MODEL_INSERT,'callback'),array('token','uniqid',self::MODEL_INSERT,'function'));
    protected $_scope = array('default'=>array());
    protected function guid(){
        $result = M()->query('select uuid() as guid');
        return $result[0]['guid'];
    }
    protected function get_url($guid){
        return 'http://127.0.0.1/asd?' . $guid;
    }
}
