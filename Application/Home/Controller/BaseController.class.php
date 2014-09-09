<?php
namespace Home\Controller;
use Think\Controller;
class BaseController extends Controller {
	public $page = 1;
	public $rows = 20;
	public $order = array();
	public $condition = array();
	
	/**
	 * 初始化入口
	 */
	public function _initialize(){
		session('user_id',83);
		session('admin', 1);
		if(isLessThenIE9()){
			$this->display('Public/killie');
			exit();
		}
		if(! session('?member') && 0){
			if(IS_AJAX){
				header('HTTP/1.1 901 Not Login');
			}else{
				if(__ACTION__ != __APP__ . '/Home/Index/index'){
					redirect(__ROOT__);
				}
				$this->display('Public/login');
			}
			exit();
		}
		
		$this->assign('isAjax', IS_AJAX);
		if(I('post.title')){
			$this->assign('title', I('post.title'));
		}
		$this->_setPage();
		$this->_bulidParams();
	}
	private function _setPage(){
		// 分页
		$this->page = I('param.page', $this->page, 'intval');
		$this->rows = I('param.rows', $this->rows, 'intval');
		// 排序
		if(I('param.sort')){
			$this->order = array(
				I('param.sort')=>I('param.order')
			);
		}
	}
	private function _bulidParams(){
		// Q_paramname_EQ
		foreach(I('param.') as $key => $value){
			if(strncmp('Q_', $key, 2) == 0 && ! empty($value)){
				
				$field = substr($key, 2, strrpos($key, '_') - 2);
				$cnd = substr($key, strrpos($key, '_') + 1);
				
				if(strripos($cnd, 'like') !== false){
					$value = '%' . $value . '%';
				}else 
					if(stripos($field, 'time')){
						$value = strtotime($value);
					}
				
				if($this->condition[$field]){
					if(is_array($this->condition[$field][0])){
						array_push($this->condition[$field], array($cnd,$value));
					}else{
						$this->condition[$field] = array($this->condition[$field],array($cnd,$value));
					}
				}else{
					$this->condition[$field] = array($cnd,$value);
				}
			}
		}
	}
	protected function returnGrid($data, $total){
		parent::ajaxReturn(array(
			'rows'=>(empty($data) ? array() : $data),'total'=>intval($total)
		));
		exit();
	}
	protected function returnStatus($status = true, $msg = null, $data = null){
		parent::ajaxReturn(array(
			'status'=>$status,'msg'=>$msg,'data'=>$data
		));
		exit();
	}
}