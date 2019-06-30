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
        // 前台接受的参数
        $userId = $_REQUEST['userId'];
        // $password = $_REQUEST['password'];
        $title = $_REQUEST['title'];
        $detail = $_REQUEST['detail'];
        $type = (int)$_REQUEST['type'];
        $link = $_REQUEST['link'];
        

        // 数据库操作
        $model = M('blogs');
        $data['author_id'] = $userId;
        $data['title'] = $title;
        // $data['detail'] = 'data:image/jpeg;base64,'.$imgurl;
        $data['content'] = $detail;
        $data['createtime'] = date('Y-m-d H:i', time());
        $data['type'] = $type;
        $data['link'] = $link;
        // $data['link'] = date('Y-m-d H:i', time());
        // $data['preview_number'] = date('Y-m-d H:i', time());
        // echo json_encode($data);
        $result = $model->add($data);
        if($result){
            $datas = array
            (
                'code'=> 1,
                'message'=> '添加文章成功',
                'blogId' => $result
            );
            echo json_encode($datas);
        }
    }
    

}
