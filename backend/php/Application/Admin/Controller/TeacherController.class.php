<?php
/**
 * Created by PhpStorm.
 * User: likui
 * Date: 2018/12/28
 * Time: 21:11
 */

namespace Admin\Controller;
use Think\Controller;

class TeacherController extends Controller
{
    public function index(){
        $teacher = M('teacher')->select();
        $this->assign('teacher',$teacher);
//        var_dump($user);
        $this -> display();
    }
}