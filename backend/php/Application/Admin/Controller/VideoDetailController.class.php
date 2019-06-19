<?php
namespace Admin\Controller;
use Think\Controller;
class VideoDetailController extends Controller {
    public function index(){
        //0.获取课程id
        $course_id = $_REQUEST['course_id'];
        //1.从数据库读取课程信息
        $video = M('video');
        $videoData = $video->where("course_id = '$course_id' ")->select();
        // 课程名称
        $course_name = M('course')->field('name,id') -> where("id = '$course_id'")->find();
        $this->assign('course_name',$course_name);
        $this->assign('course_id',$course_id);
        //dump($videoData);die;
        //2.注入数据
        $this->assign('videoData',$videoData);
        $this -> display();
    }
    public function delete($id){
//        dump($id);
        $course = M('video');
        $result = $course->where("id = '$id'")->delete();
        if($result){
            $this->success('删除成功');
        }else{
            $this->success('删除失败');
        }
    }
   
}
