<?php
namespace Home\Controller;
use Think\Controller;
use Think\Verify;
class CourseController extends Controller {
    // 得到所有课程信息
    public function index(){
        $model = M('course');
        //$count = $model->where("phone = '$phone' and password = '$password' ")->count();
        $result = $model ->select();
        if ($result) {
          echo json_encode($result);
        }
    }
    // 当前课程信息
    public function thisCourse () {
      $id = (int)$_REQUEST['courseId'];
      $model = M('course');
      $result = $model->where("id='$id'")->find(); 
      echo json_encode($result);
    }
    // 当前课程所有视频信息
    public function getVideo () {
      $course_id = (int)$_REQUEST['courseId'];
      $model = M('video');
      $result = $model->where("course_id='$course_id'")->select(); 
      echo json_encode($result);
    }
    // 当前课程所有视频信息
    public function getVideoUrl () {
      $videoId = (int)$_REQUEST['videoId'];
      $model = M('video');
      $result = $model->where("id='$videoId'")->find(); 
      echo json_encode($result);
    }
    // 添加课程访问量
    public function addview(){
      $id = (int)$_REQUEST['courseId'];
      $model = M('course');
      $model->where("id='$id'")->setInc('page_view',1); // 访问量加1
      echo json_encode($id);
    }
    //得到该课程所有评论
    public function getdiscuss(){
      // $uid = $_REQUEST['userId'];
      $cid = $_REQUEST['courseId'];

      $model = M('discuss');
      $result =  $model
          ->field('
           t1.id,
           t1.content,
           t1.add_time,
           t3.header_pic,
           t3.nickname
          ')
          // 课程表  教师表  大类表
          ->table('tb_discuss as t1,tb_course as t2,tb_user as t3')
          ->where("t1.course_id = t2.id  and   t1.user_id = t3.id and t1.course_id='$cid'")
          ->order('t1.id desc')
          ->select();
      // $Model->where('status=1')->order('id desc')->limit(5)->select();
      if ($result) {
        echo json_encode($result);
      }   
    }
    //添加评论
    public function addDiscuss() {
      // $uid = $_REQUEST['userId'];
      // $cid = $_REQUEST['courseId'];
      $data['user_id'] = $_REQUEST['userId'];
      $data['course_id'] = $_REQUEST['courseId'];
      $data['content'] = $_REQUEST['content'];
      $data['add_time'] = date('Y-m-d H:i:s', time()); //加入时间
      $discuss = M('discuss');
      $result = $discuss->add($data);
      echo json_encode($result);
    }
}
