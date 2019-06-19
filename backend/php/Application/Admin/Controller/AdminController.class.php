<?php
namespace Admin\Controller;
use Think\Controller;
class AdminController extends CommonController {
    public function index(){
      $this -> display();
    }
    public function admin()
    {
        $admin = M('admin')->select();
        $this->assign('admin',$admin);
//        var_dump($user);
        $this -> display();
    }

      //退出系统
    public function logout(){
      session(null);
      $this->success('退出成功',U('Login/index'),3);
    }

}
