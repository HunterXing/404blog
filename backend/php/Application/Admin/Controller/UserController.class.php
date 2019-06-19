<?php
/**
 * Created by PhpStorm.
 * User: likui
 * Date: 2018/12/28
 * Time: 21:11
 */

namespace Admin\Controller;
use Think\Controller;

class UserController extends Controller
{
    public function index(){
        $user = M('user')->select();
        $this->assign('user',$user);
//        var_dump($user);
        $this -> display();
    }
}