<?php
namespace Weixin\Controller;
use Com\Weixin\Media;

class MediaController extends WeixinController {

    public function index1(){
        $s = new Media();
        $result = $s->uploadMedia('C:\11.jpg', 'image');
        var_dump($result);
    }

    public function index2(){
        $s = new Media();
        $result = $s->getMedia('3O2IOnY1AkMhmj6iaxo11NyrPYBZYfnWXejIYPRXuJm8lStxzZkk_gjhFfjcwnHS');
        var_dump($result);
    }
}