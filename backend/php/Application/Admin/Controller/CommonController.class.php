<?php

namespace Admin\Controller;

use Think\Controller;

//中间层控制器  其他的控制器继承  减少登陆拦截等代码的冗余
class CommonController extends Controller{
    //登陆拦截
    function __construct()
    {
        //构造父类·
        parent::__construct();
        $name = session('name');
        //判断是否登陆
        if(empty($name)){
            $this -> error('请先登录',U('Login/index'),3);
            exit;
        }

        //0.读取个人的信息
        $username= session('name');
        $userInfo = M('teacher')->where("account = '$username' ")->find();
        //dump($userInfo);die;
        //1.将个人信息注册到模板
        $this -> assign('userInfo',$userInfo);
    }


    /* //thinkphp框架提供
   public function _initialize()
   {
     $name = session('name');
        //判断是否登陆
        if(empty($name)){
            $this -> error('请先登录',U('Login/index'),3);
            exit;
        }
   }*/
}
