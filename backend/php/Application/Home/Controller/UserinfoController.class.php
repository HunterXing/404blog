<?php
namespace Home\Controller;
use Think\Controller;
use Think\Verify;
class UserinfoController extends Controller {
    public function index(){
        $user_id = $_REQUEST['id'];
        $model = M('user');
        //$count = $model->where("phone = '$phone' and password = '$password' ")->count();
        $result = $model -> where("id = '$user_id'") -> find();
        if ($result) {
          // 返回个人信息
          // $data = array
          // (
          //   'id'=>$result['id'],  //用户的id
          //   'phone' => $result['phone'],
          //   'password' => $result['password'],
          //   'nickname' => $result['nickname'],
          //   'header_pic' => $result['header_pic'],
          //   'join_time' => $result['join_time'],
          //   'school' => $result['school'],
          //   'signature' => $result['signature'],
          //   'learn_time' => $result['learn_time'],

          // );
          // echo json_encode($data);
          echo json_encode($result);
        }
    }
}
