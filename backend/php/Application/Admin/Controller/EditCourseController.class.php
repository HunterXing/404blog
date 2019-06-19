<?php
namespace Admin\Controller;
use Think\Controller;
class EditCourseController extends Controller {
    public function index(){
        //0.获取课程id
        $course_id = $_REQUEST['course_id'];
        //1. 根据id查询课程信息
        $course = M('course');
        $course_data = $course -> where("id = '$course_id'")->find();
        //2.课程类别的数据
        $category = M('category');
        $category_data = $category -> select();
        $this->assign('category_data',$category_data);
        $this->assign('course_data',$course_data);
        //dump($course_data);die;
        //1.展示课程信息
        $this -> display();
    }

    // 更新数据
    public function updateCourse(){
        $post = I('post.');
        //dump($post);
        // 得到教师id
         //0. 获取session中的教师id
        $username= session('name');
        $teacher = M('teacher')->field('id')->where("account = '$username' ")->find();
        $teacher_id = (int)$teacher['id'];
        $course = M('course');
        $post['teacher_id'] =  $teacher_id;
        //dump($data);die;
        //上传课程海报
        if($_FILES['post']['tmp_name']!='')  //转储在服务器的临时名称不为空
        {
            $upload = new \Think\Upload();// 实例化上传类
            $upload->maxSize   =     3145728 ;// 设置附件上传大小
            $upload->exts      =     array('jpg', 'gif', 'png', 'jpeg');// 设置附件上传类型
            $upload->rootPath  =     'Public/Home/img'; // 设置附件上传根目录
            $upload->savePath  =     '/'; // 设置附件上传（子）目录
            // 上传文件
            $info   =   $upload->uploadOne($_FILES['post']);
            if(!$info) {// 上传错误提示错误信息
                $this->error($upload->getError());
            }else{// 上传成功
//                $this->success('上传成功！');
                $post['post'] = 'http://localhost/api/'.'Public/Home/img'.$info['savepath'].$info['savename'];
            }
        }
        // dump($post);die;
        $result = $course->save($post);
        if ($result){
            $this->success('更改成功!',U('CourseDetail/index'));
        }else{
            $this->error('更改失败!');
        }
    }
}
