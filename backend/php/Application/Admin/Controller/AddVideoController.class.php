<?php
namespace Admin\Controller;
use Think\Controller;
class AddVideoController extends Controller {
    public function index(){
        //   // 课程id
          $course_id = $_REQUEST['course_id'];
          $course_name = M('course')->field('name') -> where("id = '$course_id'")->find();
          $this->assign('course_name',$course_name);
          $this->assign('course_id',$course_id);
        //    dump($course_name);die;
          $this->display();
    }
    public function doadd(){
        $video              = M('video');
        $data               = $video->create();
        $course_id          = $_REQUEST['course_id'];
        $video_name          = $_REQUEST['video_name'];
        // $teacher            = $_REQUEST['teacher'];
        $data['course_id']  = $course_id;
        $data['name']  = $video_name;
        if($_FILES['video']['tmp_name']!='')  //转储在服务器的临时名称不为空
        {
            $upload           =     new \Think\Upload();// 实例化上传类
            $upload->maxSize  =     0 ;// 设置附件上传大小
            $upload->exts     =     array('mp4');// 设置附件上传类型
            $upload->rootPath =     'Public/Upload/video'; // 设置附件上传根目录
            $upload->savePath =     '/'; //设置附件上传（子）目录
            // 上传文件
            $info   =   $upload->upload();
            if(!$info) {// 上传错误提示错误信息
                $this->error($upload->getError());
            }else{// 上传成功
//                $this->success('上传成功！');
                foreach($info as $file)
                {
                    $data['video_url'] = 'http://localhost/api/'.'Public/Upload/video'.$file['savepath'].$file['savename'];
                }
            }
        }
       // dump($data);
        $result = $video->add($data);
        if ($result){
            $this->success('添加成功!',U('VideoDetail/index',array('course_id'=>$course_id)));
            // $this->redirect("VideoDetail/index",array("course_id"=>"$course_id"));
        }else{
            $this->error('添加失败!');
        }
    }
}
