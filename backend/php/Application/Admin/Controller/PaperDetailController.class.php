<?php
namespace Admin\Controller;
use Think\Controller;
class PaperDetailController extends Controller {

    //0.初始化试卷列表
    public function index(){
        //1.连表查询
        $paperModel = M('testpaper');
        //2.分页七步骤
        #1. 查询总的记录数
        $count = $paperModel -> count();
        #2. 实例化分页类 传递参数
        $page = new \Think\Page($count,10);//每页显示一条数据
        #3.（可选步骤） 定制分页按钮提示文字
        $page -> rollPage = 5; //大于多少时展示收末页
        $page -> lastSuffix = false;//是否显示末页数字
        $page -> setConfig('prev','上一页');
        $page -> setConfig('next','下一页');
        $page -> setConfig('first','首页');
        $page -> setConfig('last','末页');
        #4. 通过show方法输出分页的url链接
        $show = $page -> show();
        #5. 使用limit方法查询数据
        $paperData = $paperModel
            -> join('tb_course ON tb_testpaper.course_id = tb_course.id')//将教师表和视频表连接
            ->field('tb_testpaper.id,tb_testpaper.title,tb_testpaper.paper_time,tb_course.course_name')
            -> limit($page->firstRow,$page -> listRows)
            -> select();
        #6. 传递给模板
        $this -> assign('paperData',$paperData);
        $this -> assign('show',$show);
        $this -> assign('count',$count);
        #7. 展示模板
        $this -> display();

    }


    //1.删除试卷
    public  function  delPaper(){
        $id = I('get.id');
        $result = M('testpaper') -> delete($id);
        echo $result;
    }
}
