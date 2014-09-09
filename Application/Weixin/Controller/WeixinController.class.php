<?php
namespace Weixin\Controller;
use Home\Controller\BaseController;

class WeixinController extends BaseController {

    /**
     * 判断是否错误
     * @param content string
     * @param success_msg string
     * @return Ambigous <multitype:, object>|boolean
     */
    protected function checkStatus($content, $success_msg){
        $arr = obj2arr(json_decode($content));
        if($arr['errcode']){
            $this->returnStatus(false, '错误码: ' . $arr['errcode'] . '<br>错误说明: ' . $arr['errmsg']);
        }elseif($arr == NULL || $arr == false){
            $this->returnStatus(false, '运行时出错');
        }else{
            $this->returnStatus(true, $success_msg);
        }
    }
}