<?php
namespace Org\Util;
class Curl {
    private $ch;

    /**
     * 初始化
     */
    public function __construct(){
        $this->ch = curl_init();
    }

    /**
     * 创建post数据
     * @param [json|array] data
     */
    public function createData($data){
        curl_setopt($this->ch, CURLOPT_POSTFIELDS, $data);
    }

    /**
     * 执行
     * @param url string 
     * @param type [GET|POST|PUT|DELETE]
     * @return mixed
     */
    public function execute($url, $type){
        curl_setopt($this->ch, CURLOPT_URL, $url);
        curl_setopt($this->ch, CURLOPT_SSL_VERIFYHOST, 0);
        curl_setopt($this->ch, CURLOPT_SSL_VERIFYPEER, 0);
        curl_setopt($this->ch, CURLOPT_CUSTOMREQUEST, $type);
        curl_setopt($this->ch, CURLOPT_USERAGENT, 'Mozilla/5.0 (Windows NT 5.2; rv:26.0) Gecko/20100101 Firefox/26.0');
        curl_setopt($this->ch, CURLOPT_FOLLOWLOCATION, 1);
        curl_setopt($this->ch, CURLOPT_TIMEOUT, 30);
        curl_setopt($this->ch, CURLOPT_AUTOREFERER, 1);
        curl_setopt($this->ch, CURLOPT_RETURNTRANSFER, 1);
        
        $content = curl_exec($this->ch);
        return $content;
    }
    public function __destruct(){
        curl_close($this->ch);
    }
}