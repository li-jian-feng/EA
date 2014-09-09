<?php

function p($msg){
    var_dump($msg);
}

function isLessThenIE9(){
    if(strpos($_SERVER['HTTP_USER_AGENT'], 'MSIE 6.0') || strpos($_SERVER['HTTP_USER_AGENT'], 'MSIE 7.0') || strpos($_SERVER['HTTP_USER_AGENT'], 'MSIE 8.0') || strpos($_SERVER['HTTP_USER_AGENT'], 'MSIE 9.0')){
        return true;
    }
    return false;
}

function str2arr($str, $delimiter){
    return explode($delimiter, $str);
}

function arr2str($arr, $glue){
    return implode($glue, $arr);
}

/**
 * 时间格式
 * @param string timestamp
 * @return string 'xxxx-xx-xx xx:xx:xx'
 */
function dt_format($timestamp = NOW_TIME){
    return date('Y-m-d H:i:s', $timestamp);
}

/**
 * 遍历对象转换为数组
 * @param object $obj
 * @return array
 */
function obj2arr($obj){
    $arr = is_object($obj) ? get_object_vars($obj) : $obj;
    if(is_array($arr)){
        return array_map('obj2arr', $arr);
    }else{
        return $arr;
    }
}

/**
 * 删除数组中为空字符串的键值对 只适合二维数组
 * @param array arr
 * @return array
 */
function unset_empty(array $arr){
    foreach($arr as $k => $v){
        if($v === ''){
            unset($arr[$k]);
        }
    }
    return $arr;
}

?>