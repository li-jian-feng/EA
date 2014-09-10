<?php
namespace Com\Weixin;
class Media extends Weixin {

    /**
     * 上传多媒体文件
     * @param string media "绝对路径"
     * @param string type (image|voice|video|thumb)
     * @return json {"type":"image|xxx","media":"xxxxxx","created_at":timestamp}
     */
    public function uploadMedia($media, $type){
        $url = 'http://file.api.weixin.qq.com/cgi-bin/media/upload?access_token=' . $this->ACCESS_TOKEN . '&type=' . $type;
        $files = array('media'=>'@' . $media);
        $this->ch->createData($files);
        return $this->ch->execute($url, 'POST');
    }

    /**
     * 下载多媒体文件
     */
    public function getMedia($media_id){
        $url = 'http://file.api.weixin.qq.com/cgi-bin/media/get?access_token=' . $this->ACCESS_TOKEN . '&media_id=' . $media_id;
        $content = $this->ch->execute($url, 'GET');
        return $this->saveMedia(date('H_i_s') . '.jpg', $content);
    }

    /**
     * 将获取的多媒体文件保存到本地
     */
    public function saveMedia($filename, $content){
        $filename = C('WEIXIN_MEDIA.SAVEPATH') . $filename;
        $handle = fopen($filename, 'w');
        if(false !== $handle){
            if(false !== fwrite($handle, $content)){
                fclose($handle);
                return $filename;
            }
        }
        return false;
    }
}