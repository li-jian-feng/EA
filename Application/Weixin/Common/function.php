<?php

/**
 * 转换数据格式为微信支持的格式
 * @param array $arr
 * @return array
 */
function menu_format(array $arr){
    foreach($arr as $k => $v){
        if(empty($v)){
            unset($arr[$k]);
        }
        if(is_array($v) && count($v)){
            $arr[$k] = array_map('menu_format', $v);
            unset($arr['type']);
        }
        foreach(str2arr('id,pid,sort', ',') as $u){
            unset($arr[$u]);
        }
    }
    return $arr;
}

function json_encode_menu($data){
    $tmp = json_encode($data);
    $str = preg_replace("/\/u/", json_decode($json), $tmp);
}

function arrayRecursive(&$array, $function, $apply_to_keys_also = false){
    static $recursive_counter = 0;
    if(++ $recursive_counter > 1000){
        die('possible deep recursion attack');
    }
    foreach($array as $key => $value){
        if(is_array($value)){
            arrayRecursive($array[$key], $function, $apply_to_keys_also);
        }else{
            $array[$key] = $function($value);
        }
        
        if($apply_to_keys_also && is_string($key)){
            $new_key = $function($key);
            if($new_key != $key){
                $array[$new_key] = $array[$key];
                unset($array[$key]);
            }
        }
    }
    $recursive_counter --;
}

/**
 * 将数组转化为json格式 其中中文字符保留不转换
 * @param data array
 */
function arr2json($data){
    arrayRecursive($data, 'urlencode', true);
    return urldecode(json_encode($data));
}