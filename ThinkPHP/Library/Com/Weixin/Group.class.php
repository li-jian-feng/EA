<?php
namespace Com\Weixin;
class Group extends Weixin {

    /**
     * 创建分组
     * @param string groupname
     */
    public function createGroup($groupname){
        $url = $this->url . 'groups/create?access_token=' . $this->ACCESS_TOKEN;
        $data = '{"group":{"name":"' . $groupname . '"}}';
        $this->ch->createData($data);
        return $this->ch->execute($url, 'POST');
    }

    /**
     * 查询所有分组
     */
    public function getGroups(){
        $url = $this->url . 'groups/get?access_token=' . $this->ACCESS_TOKEN;
        return file_get_contents($url);
    }

    /**
     * 查询用户所在分组
     * @param string openid
     */
    public function getGroupByUserId($openid){
        $url = $this->url . 'groups/getid?access_token=' . $this->ACCESS_TOKEN;
        $data = '{"openid":"' . $openid . '"}';
        $this->ch->createData($data);
        return $this->ch->execute($url, 'POST');
    }

    /**
     * 修改分组名
     * @param int groupid
     * @param string groupname
     */
    public function updateGroup($groupid, $groupname){
        $url = $this->url . 'groups/update?access_token=' . $this->ACCESS_TOKEN;
        $data = '{"group":{"id":' . $groupid . ',"name":"' . $groupname . '"}}';
        $this->ch->createData($data);
        return $this->ch->execute($url, 'POST');
    }

    /**
     * 移动用户分组
     * @param string openid
     * @param string groupid
     */
    public function moveToGroup($openid, $groupid){
        $url = $this->url . 'groups/members/update?access_token=' . $this->ACCESS_TOKEN;
        $data = '{"openid":"' . $openid . '","to_groupid":' . $groupid . '}';
        $this->ch->createData($data);
        return $this->ch->execute($url, 'POST');
    }
}