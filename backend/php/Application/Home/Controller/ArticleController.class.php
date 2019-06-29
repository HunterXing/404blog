<?php
namespace Home\Controller;
use Think\Controller;

// 这是对文章的操作
class ArticleController extends Controller {
    
    // 查询所有的文章
    public function index(){
        $model = M('blogs');
        $result = $model -> select();
        echo json_encode($result);
    }

    // 保存文章
    public function saveArticle() {
        $userId = $_REQUEST['userId'];
        $title = $_REQUEST['title'];
        $code = $_REQUEST['code'];
    }

    // 新增文章
    public function addArticle() {
        $userId = $_REQUEST['userId'];
        $title = $_REQUEST['title'];
        $detail = $_REQUEST['detail'];
        $create_time = time();
    }
    

}
