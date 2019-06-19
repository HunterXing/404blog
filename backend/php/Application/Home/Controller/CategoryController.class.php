<?php
namespace Home\Controller;
use Think\Controller;
use Think\Verify;
class CategoryController extends Controller {
    public function index(){
        $model = M('category');
        $result = $model -> select();
        echo json_encode($result); 
    }
}
