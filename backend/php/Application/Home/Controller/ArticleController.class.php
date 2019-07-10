<?php
namespace Home\Controller;
use Think\Controller;
// 这是对文章的操作
class ArticleController extends Controller {
    
     // 得到自己的文章 
     public function getMyArticle(){
        $userId = $_REQUEST['userId'];
        $model = M('blogs');
        $result =  $model
          ->field('
            t1.id as articleId,
            t1.*,
            t2.*
          ')
          // 博客表  用户表 
          ->table('tb_blogs as t1,tb_users as t2')
          ->where("t1.author_id = t2.id and t2.id='$userId'  and t1.show =1 and t1.state = 1")
          ->order('t1.createtime desc')
          ->select();
         
        if ($result) {
            $datas = array
            (
                'code'=> 1,
                'message'=> '获取自己的文章成功',
                'result' => $result
            );
            echo json_encode($datas);
        } else {
            $datas = array
            (
                'code'=> 0,
                'message'=> '获取内容失败',
                'result' => $result
            );
            echo json_encode($datas);
        }
        
    }

     // 得到推荐文章
     public function getRecommend(){
        $model = M('blogs');
        $result =  $model
          ->field('
            t1.id as articleId,
            t1.*,
            t2.*
          ')
          // 博客表  用户表 
          ->table('tb_blogs as t1,tb_users as t2')
          ->where("t1.author_id = t2.id and t1.show =1 and t1.state = 1")
          ->order('t1.preview desc')
          ->limit(10)
          ->select();
         
        if ($result) {
            $datas = array
            (
                'code'=> 1,
                'message'=> '获取热门文章成功',
                'result' => $result
            );
            echo json_encode($datas);
        } else {
            $datas = array
            (
                'code'=> 0,
                'message'=> '获取内容失败',
                'result' => $result
            );
            echo json_encode($datas);
        }
        
    }

    // 得到文章详情
    public function getDetail(){
        $blogId = $_REQUEST['blogId'];
        $model = M('blogs');
        $result =  $model
          ->field('
            t1.*,
            t2.*
          ')
          // 博客表  用户表 
          ->table('tb_blogs as t1,tb_users as t2')
          ->where("t1.author_id = t2.id and t1.id='$blogId' and t1.show =1 and t1.state = 1")
          ->find();
         
        if ($result) {
            $datas = array
            (
                'code'=> 1,
                'message'=> '获取文章详情成功',
                'result' => $result
            );
            echo json_encode($datas);
        }
    }

    // 保存文章
    // public function saveArticle() {
    //     $userId = $_REQUEST['userId'];
    //     $title = $_REQUEST['title'];
    //     $code = $_REQUEST['code'];
    // }

    // 新增文章
    public function addArticle() {
        // 前台接受的参数
        $userId = $_REQUEST['userId'];
        // $password = $_REQUEST['password'];
        $title = $_REQUEST['title'];
        $detail = $_REQUEST['detail'];
        $type = (int)$_REQUEST['type'];
        $link = $_REQUEST['link'];
        $markdown = $_REQUEST['markdown'];

        // 数据库操作
        $model = M('blogs');
        $data['author_id'] = $userId;
        $data['title'] = $title;
        // $data['detail'] = 'data:image/jpeg;base64,'.$imgurl;
        $data['content'] = $detail;
        $data['createtime'] = date('Y-m-d H:i', time());
        $data['type'] = $type;
        $data['link'] = $link;
        $data['markdown'] = $markdown;
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
        } else {
            $datas = array
            (
                'code'=> 0,
                'message'=> '添加文章失败',
            );
            echo json_encode($datas);
        }
    }

    // 删除文章  软删除
    public function delArticle() {
        $blogId = $_REQUEST['blogId'];
        $hasLogin = $_REQUEST['hasLogin'];
        $userId = $_REQUEST['userId'];
        if ($hasLogin) {
            $model = M('blogs'); 
            // 判断是否为自己的博客
            $isMyBlog = $model -> where("author_id = '$userId' and id = '$blogId' ") -> find();
            // dump($isMyBlog);
            // die;
            if (isMyBlog) {
                $model -> id = $blogId;
                $model -> show = 0;
                $result = $model -> save();
                if ($result) {
                    $datas = array
                    (
                        'code'=> 1,
                        'message'=> '删除文章成功',
                        'result' => $result
                    );
                    echo json_encode($datas);
                } else {
                    $datas = array
                    (
                        'code'=> 0,
                        'message'=> '删除文章失败',
                        'result' => $result
                    );
                    echo json_encode($datas);
                }
            }

            
        }
       
    }

    // 得到编辑文章的内容
    public function getEditArticle(){
        $blogId = $_REQUEST['blogId'];
        $model = M('blogs');
        $result = $model-> where("id = '$blogId' ") -> find();
        if ($result) {
            $datas = array
            (
                'code'=> 1,
                'message'=> '获取文章成功',
                'result' => $result
            );
            echo json_encode($datas);
        }   
        
    }
     // 编辑文章
    public function editArticle() {
        $blogId = $_REQUEST['blogId'];
        $hasLogin = $_REQUEST['hasLogin'];
        $userId = $_REQUEST['userId'];
        $title = $_REQUEST['title'];
        $detail = $_REQUEST['detail'];
        $type = (int)$_REQUEST['type'];
        $link = $_REQUEST['link'];
        $markdown = $_REQUEST['markdown'];

        if ($hasLogin) {
            $model = M('blogs'); 
            // 判断是否为自己的博客
            $isMyBlog = $model -> where("author_id = '$userId' and id = '$blogId' ") -> find();
           
            if (isMyBlog) {
                $model -> id = $blogId;
                $model -> title = $title;
                $model -> content = $detail;
                $model -> type = $type;
                $model -> markdown = $markdown;
                $model -> link = $link;
                $result = $model -> save();
                if ($result) {
                    $datas = array
                    (
                        'code'=> 1,
                        'message'=> '编辑文章成功',
                        'result' => $result
                    );
                    echo json_encode($datas);
                } else {
                    $datas = array
                    (
                        'code'=> 0,
                        'message'=> '编辑文章失败',
                        'result' => $result
                    );
                    echo json_encode($datas);
                }

            }
        }
       
    }
    
     // 添加博客访问量
     public function addview(){
        $blogId = (int)$_REQUEST['blogId'];
        $model = M('blogs');
        $result = $model->where("id='$blogId'")->setInc('preview',1); // 访问量加1
        echo json_encode($result);
      }
      //得到该课程所有评

}
