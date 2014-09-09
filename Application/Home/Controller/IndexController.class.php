<?php
namespace Home\Controller;
use Org\Net\IpLocation;
class IndexController extends BaseController {
	
	public function _initialize(){
		parent::_initialize();
	}
	
	public function index(){
		$Ip = new IpLocation();
		$this->assign('ip',get_client_ip());
		$this->assign('area',$Ip->getlocation($this->ip));
		$this->display();
	}
}