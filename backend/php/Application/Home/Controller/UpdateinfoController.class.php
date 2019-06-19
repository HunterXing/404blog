<?php
namespace Home\Controller;
use Think\Controller;
use Think\Verify;
class UpdateinfoController extends Controller {
    public function index(){
        $user_id = $_REQUEST['id'];
        $signature = $_REQUEST['signature'];
        $nickname = $_REQUEST['nickname'];
        $password = $_REQUEST['password'];

        $model = M('user');
        // $result = $model -> where("id = '$user_id'") -> find();
        // $password = 
        $model -> id = $user_id;
        $model -> password =  $password;
        $model -> nickname =  $nickname;
        $model -> signature = $signature;
        $result = $model -> save();
        // echo $result;
        echo $result;
    }
}
