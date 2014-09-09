<?php
namespace Home\Model;
use Think\Model\AdvModel;
class UserModel extends AdvModel {
	protected $pk = 'user_id';
	
	/*
	 * 自动验证 array(验证字段1,验证规则,错误提示,[验证条件,附加规则,验证时间])
	 */
	protected $_validate = array(
		array('username','require','用户名不能为空')	,
		array('username','','用户名已经存在',self::MUST_VALIDATE,'unique',self::MODEL_BOTH),
		array('email','require','邮箱不能为空'),
		array('email','','邮箱已存在',self::MUST_VALIDATE,'unique',self::MODEL_BOTH)
	);
	
	// 自动完成 array(完成字段1,完成规则,[完成条件时间,附加规则])
	protected $_auto = array(
		array('create_time',NOW_TIME,self::MODEL_INSERT),
		array('password','md5',self::MODEL_BOTH,'function')
	);
	protected $_filter = array(
		'login_ip'=>array('','long2ip'),
		'create_time'=>array('','dt_format')
	);
	protected $_scope = array(
		'default' => array(
			'where' => array('status'=>1)
		),
		'disable' => array(
			'where' => array('status'=>2)
		)
	);
	public function login($uid){
		
	}
	public function logout(){
		
	}
}