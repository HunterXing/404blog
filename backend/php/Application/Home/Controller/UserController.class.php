<?php
namespace Home\Controller;
use Think\Controller;
use Think\Verify;

class UserController extends Controller {
    public function login(){
        $username = $_REQUEST['username'];
        $password = $_REQUEST['password'];
        $model = M('users');
        $result = $model -> where("username = '$username' and password = '$password' ") -> find();
        if ($result) {
          // 返回个人信息
          $data = array
          (
            'code' => '1',
            'id' => $result['id']
          );
          echo json_encode($data);
        } else {
          $data = array
          (
            'code' => '-1'
          );
          echo json_encode($data);
        }
    }
}