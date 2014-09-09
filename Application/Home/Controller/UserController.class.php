<?php
namespace Home\Controller;
use Think\Model;
class UserController extends BaseController {
	public function index(){
		$this->display();
	}
	public function getData(){
		$User = D('User');
		$data = $User->where($this->condition)->page($this->page, $this->rows)->order($this->order)->select();
		$total = $User->where($this->condition)->count();
		$this->returnGrid($data, $total);
	}
	public function doDelete(){
		$ids = str2arr(I('post.ids'), ',');
		$User = D('User');
		$roleUser = D('RoleUser');
		foreach($ids as $id){
			$User->startTrans();
			if($User->where(array('user_id'=>$id))->setField('status', 2) !== false){ // 后期添加角色后还要删除用户在角色里的信息
				$User->commit();
			}else{
				$User->rollback();
			}
		}
		$this->returnStatus();
	}
	public function toAdd(){
		$this->display('add');
	}
	public function doSave(){
		$User = D('User');
		$Api = D('Weixin/Api');
		
		if(! $User->create()){
			$this->returnStatus(false, $User->getError());
		}else{
			$User->startTrans();
			$result = false;
			
			if(empty($User->user_id)){
				$result = $User->add();
			}else{
				$result = $User->save();
			}
			if($result !== false){
				$Api->create(array('user_id'=>$result));
				if($Api->add() === false){
					$User->rollback();
					$this->returnStatus(false,M()->getDbError());
				}
				$User->commit();
				$this->returnStatus();
			}else{
				$User->rollback();
				$this->returnStatus(false);
			}
		}
	}
	public function toUpdate(){
		$this->display('add');
	}
}