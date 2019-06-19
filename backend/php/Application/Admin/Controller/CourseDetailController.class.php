<?php
namespace Admin\Controller;
use Think\Controller;
class CourseDetailController extends Controller {
    public function index(){
        // 查看权限
        $role = session('role');
        if ($role) {
             //0. 获取session中的教师id
            $username= session('name');
            $teacher = M('teacher')->field('id')->where("account = '$username' ")->find();
            $teacher_id = (int)$teacher['id'];
            //1.从数据库读取课程信息
            $course = M('course');
            $coursedata = $course->where("teacher_id = '$teacher_id' ")->select();
        // dump($coursedata);
            //2.注入数据
            $this->assign('coursedata',$coursedata);
            $this -> display();
        }else{
            $course = M('course');
            $coursedata = $course->select();
        // dump($coursedata);
            //2.注入数据
            $this->assign('coursedata',$coursedata);
            $this->assign('role',$role);
            $this -> display();
        }
       
    }
    public function delete($id){
//        dump($id);
        $course = M('course');
        $result = $course->where("id = '$id'")->delete();
        if($result){
            $this->success('删除成功');
        }else{
            $this->success('删除失败');
        }
    }
   
}
