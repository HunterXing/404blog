<?php
namespace Home\Controller;
use Think\Controller;
use Think\Verify;
class FindController extends Controller {

    // 发现热门的课程
    public function findhot(){
        $model = M('course');
        // $result = $model ->order('page_view desc')->limit(1)->select();

        // 获取热门课程  按照浏览量分辨热门与否， 选取浏览量前几的数据
        $result =  $model
            ->field('
            t1.name as course_name,
            t1.course_intro as course_intro,
            t1.page_view,
            t1.post,
            t1.id,
            t2.name as teacher_name,
            t3.name as category_name
            ')
            // 课程表  教师表  大类表
            ->table('tb_course as t1,tb_teacher as t2,tb_category as t3')
            ->where('t1.teacher_id = t2.id  and   t1.category_id = t3.id')
            ->order('page_view desc')
            ->limit(3)
            ->select();
        // $Model->where('status=1')->order('id desc')->limit(5)->select();
        if ($result) {
          echo json_encode($result);
        }   
    }

     // 发现推荐课程   用户量太少，后期尝试协同过滤算法
     public function recommend(){
        $model = M('course');
        // 随机推荐课程 
        $result =  $model
            ->field('
                t1.name as course_name,
                t1.course_intro as course_intro,
                t1.page_view,
                t1.post,
                t1.id,
                t2.name as teacher_name,
                t3.name as category_name
            ')
            // 课程表  教师表  大类表
            ->table('tb_course as t1,tb_teacher as t2,tb_category as t3')
            ->where('t1.teacher_id = t2.id  and   t1.category_id = t3.id')
            ->order('rand()')
            ->limit(3)
            ->select();
        // $Model->where('status=1')->order('id desc')->limit(5)->select();
        if ($result) {
          echo json_encode($result);
        }   
    }
}
