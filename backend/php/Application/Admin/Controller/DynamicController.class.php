<?php
namespace Admin\Controller;
use Think\Controller;

class DynamicController extends Controller
{
    public function index(){
        $dynamic = M('dynamic')
                    ->join('tb_user ON tb_dynamic.user_id = tb_user.id')
                    ->select();
        $this->assign('dynamic',$dynamic);
      //  dump($dynamic);
        $this -> display();
    }
}