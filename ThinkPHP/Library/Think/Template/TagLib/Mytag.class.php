<?php
namespace Think\Template\TagLib;
use Think\Template\TagLib;

class Mytag extends TagLib {
    protected $tags = array('script'=>array('attr'=>'pack,src','close'=>0));

    public function _script($tag){
        $pack = $tag['pack'];
        $src = $tag['src'];
        $scriptDir = C('TMPL_PARSE_STRING');
        $addr = $_SERVER['SERVER_ADDR'];
        $dir = 'http://'.$addr.':' . $_SERVER['SERVER_PORT'] . $scriptDir['__JS__'] . '/' . $src;
        $file_context = file_get_contents($dir);
        return <<<SCRIPT
<script>
	NameSpace("$pack",function(){
	var context = this;
	$file_context
	});
</script>
SCRIPT;
    }
}
