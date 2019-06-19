<?php
namespace Home\Controller;
use Think\Controller;
use Think\Verify;
class UpdateimgController extends Controller {
    public function index(){
       $post = I('post.');
       $model = D('User');
       $result = $model -> updateData($post,$_FILES['file']);
       dump ($_FILES['file']);
    }
}
