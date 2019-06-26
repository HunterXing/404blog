<?php
namespace Home\Controller;
use Think\Controller;
// 制定允许其他域名访问
header("Access-Control-Allow-Origin:*");
// 响应类型
header('Access-Control-Allow-Methods:POST');
// 响应头设置
header('Access-Control-Allow-Headers:x-requested-with, content-type');
// 这是对文章的操作
class ArticleController extends Controller {
    
    // 查询所有的文章
    public function index(){
        $model = M('blogs');
        $result = $model -> select();
        echo json_encode($result);
    }
}
