<?php
namespace Admin\Controller;
use Think\Controller;
class AddCourseController extends Controller {
    // 展示添加课程的页面
    public function index(){
        $category = M('category');
        $data = $category -> select();
        $this->assign('data',$data);
        $this -> display();
    }
    public function doadd(){
        //0. 获取session中的教师id
        $username= session('name');
        $teacher = M('teacher')->field('id')->where("account = '$username' ")->find();
        $teacher_id = (int)$teacher['id'];
        $data = I('post.');
        // $course = M('course');
        //$data = $course->create();
        $course = M('course');
        $data['teacher_id'] =  $teacher_id;
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
                $data['post'] =  'http://localhost/api/'.'Public/Home/img'.$info['savepath'].$info['savename'];
            }
        }

//        dump($data);
        $result = $course->add($data);
        if ($result){
            $this->success('添加成功!',U('AddCourse/index'));
        }else{
            $this->error('添加失败!');
        }
    }
}
