<?php
namespace Admin\Controller;
use Think\Controller;

/**
 * use Common\Model 这块可以不需要使用，框架默认会加载里面的内容
 */
class LoginController extends Controller {

    public function index(){
       if (session('admin')) {
       $this->redirect(U('Admin/Index'));
       }
    	return $this->display();
    }
    
    public function check(){
    	$username=$_POST['username']?$_POST['username']:'';
    	$password=$_POST['password']?$_POST['password']:'';

    	if (!trim($username) || !trim($password)) {
    		return show(0,'为空');
    	}
    	 $ret=D('Admin')->getAdminInfo($username);
    	
    	 if (!$ret) {
    	 	return show(0,'用户不存在');
    	 }
    	 if ($ret['password'] != getMd5Password($password)) {
    	 	return show(0,'密码错误');
    	 }

    	 session('admin',$ret);
    	 return show(1,'登陆成功');

    }

    public function loginout(){
    	session('admin',null);
    	$this->redirect(U('Admin/Login'));
    }
}