<?php
namespace Home\Controller;
use Think\Controller;
use Think\Verify;
class ChooseschoolController extends Controller {
    public function index(){
        // 用户的id
        $user_id = $_REQUEST['id'];
        // 用户选择的学校
        $school = $_REQUEST['choosedSchool'];
        $model = M('user');
        $model -> id = $user_id;
        $model -> school = $school;
        $result = $model -> save();
        echo $result;
    }
}
