<?php
namespace Home\Controller;
use Think\Controller;

class SearchController extends Controller {
    // 得到该用户所有历史记录
    public function getHistory(){
        $user_id = (int)$_REQUEST['userId'];
        $model = M('history');
        $result = $model ->where("user_id = '$user_id'")->select();
        if ($result) {
          echo json_encode($result);
        }
    }
    // 清空所有历史记录
    public function deleteHistory(){
        $user_id = (int)$_REQUEST['userId'];
        $model = M('history');
        $result = $model ->where("user_id = '$user_id'")->delete();
        if ($result) {
          echo json_encode($result);
        }
    }
    // 得到热门搜索
    public function getHot(){
        $model = M('hotsearch');
        // 得到最热门的五条搜索
        $result = $model ->order('search_number desc')->limit(5)->select();
        if ($result) {
          echo json_encode($result);
        }
    }
   
    // 得到符合要求的课程
    public function getCourse(){
        $content = $_REQUEST['content'];
        $map['name'] =array('like','%'.$content.'%');
        $model = M('course');
        $result =  $model
        ->where($map)
        ->order('page_view desc')
        ->select();

        $count =  $model
        ->where($map)
        ->order('page_view desc')
        ->count();

        
        if ($result) {
            echo json_encode($result);
        }   
    }
     // 将自己的搜索历史加入数据库
     public function addhistory(){
        $user_id = (int)$_REQUEST['userId'];
        $content = $_REQUEST['content'];
        $model = M('history');
        $count = $model -> where("user_id = '$user_id' and content = '$content' ") ->count();
        if (!$count) {
            $model -> user_id = $user_id;
            $model -> content = $content;
            $model -> add();
            if ($result) {
                echo json_encode($result);
            }
        }
    }
     // 热门搜索数据库操作
     public function addhot(){
        $content = $_REQUEST['content'];
        $model = M('hotsearch');
        $count = $model -> where("content = '$content' ") ->count();
        if ($count) {
            $model->where("content='$content'")->setInc('search_number',1); // 热度加1
        } else {
            $model -> content = $content;
            $model -> search_number = 1;
            $model -> add();
        }
    }
}
