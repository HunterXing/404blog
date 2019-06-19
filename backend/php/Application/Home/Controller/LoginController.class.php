<?php
namespace Home\Controller;
use Think\Controller;
use Think\Verify;
class LoginController extends Controller {
    public function index(){
        $phone = $_REQUEST['phone'];
        $password = $_REQUEST['password'];
        $model = M('user');
        //$count = $model->where("phone = '$phone' and password = '$password' ")->count();
        $result = $model -> where("phone = '$phone' and password = '$password' ") -> find();
        if ($result) {
          // 返回个人信息
          $data = array
          (
            'id'=>$result['id'],  //用户的id
          );
          echo json_encode($data);
        }
    }
}
