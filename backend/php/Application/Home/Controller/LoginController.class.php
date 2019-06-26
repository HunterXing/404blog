<?php
namespace Home\Controller;
use Think\Controller;
use Think\Verify;
class LoginController extends Controller {
    public function index(){
        $username = $_REQUEST['username'];
        $password = $_REQUEST['password'];
        $model = M('users');
        $result = $model -> where("username = '$username' and password = '$password' ") -> find();
        if ($result) {
          // 返回个人信息
          $data = array
          (
            'id' => $result['id'],  //用户的id
          );
          echo json_encode($data);
        }
    }
}

