<?php
namespace Home\Controller;
use Think\Controller;
use Think\Verify;
// 制定允许其他域名访问
header("Access-Control-Allow-Origin:*");
// 响应类型
header('Access-Control-Allow-Methods:POST');
// 响应头设置
header('Access-Control-Allow-Headers:x-requested-with, content-type');
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
            'code' => '1',
            'id' => $result['id'],  //用户的id
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