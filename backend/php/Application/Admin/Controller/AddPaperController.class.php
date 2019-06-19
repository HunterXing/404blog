<?php
namespace Admin\Controller;
use Think\Controller;
class AddPaperController extends Controller {
    //初始化添加试卷的首页
    public function index(){
        //0.跟据教师的教师编号获取到他拥有的课程id
        $teacher_id = 1;//本来是教师登录之后获取

        //1.连表查询
        $videoModel = M('video');
        $courseNames = $videoModel
            ->join('tb_course ON tb_video.course_id = tb_course.id')//将教师表和视频表连接
            ->where("tb_video.teacher_id = '$teacher_id'")
            ->field('tb_course.course_name,tb_course.id')
            ->group('id')
            ->select();
        //dump($courseNames);die;
        //2.注册数据
        $this->assign('courseNames',$courseNames);
        //3.展示模板
        $this -> display();
    }

    //提交试卷信息
    public function testInfo(){
        $title = $_REQUEST['title'];
        $id = $_REQUEST['course_id'];
        $paper_time = date("Y-m-d",time()) ;

        $data = array(
            'title'      => $title,
            'course_id'  => $id,
            'paper_time' => $paper_time,
        );

        $model = M('testpaper');
        $result = $model -> add($data);
        //$this->redirect('index');
        echo json_encode($result);
    }

    //上传试卷并解析 插入题库
    public function upload() {
       /* $post = I('post.');
        dump($post);die;*/
        ini_set('memory_limit','1024M');
        if (!empty($_FILES)) {
            $config = array(
                'exts'     => array('xlsx','xls'),
                'maxSize'  => 3145728000,
                'rootPath' => "./Public/",
                'savePath' => 'Upload/',
                'subName'  => array('date','Ymd'),
            );
            $upload = new \Think\Upload($config);
            if (!$info = $upload->upload()) {
                $this->error($upload->getError());
            }
            vendor("PHPExcel.PHPExcel");
            $file_name = $upload->rootPath.$info['photo']['savepath'].$info['photo']['savename'];
            $extension = strtolower(pathinfo($file_name, PATHINFO_EXTENSION));//判断导入表格后缀格式
            if ($extension == 'xlsx') {
                $objReader =\PHPExcel_IOFactory::createReader('Excel2007');
                $objPHPExcel =$objReader->load($file_name, $encode = 'utf-8');
            } else if ($extension == 'xls'){
                $objReader =\PHPExcel_IOFactory::createReader('Excel5');
                $objPHPExcel =$objReader->load($file_name, $encode = 'utf-8');
            }
            $sheet =$objPHPExcel->getSheet(0);
            $highestRow = $sheet->getHighestRow();//取得总行数
            $highestColumn =$sheet->getHighestColumn(); //取得总列数
            //D('question')->execute('truncate table question');
            for ($i = 2; $i <= $highestRow; $i++) {//从第二行开始读取导入 第一行是字段的标题
                //看这里看这里,前面小写的a是表中的字段名，后面的大写A是excel中位置
                $data['paperid']  = $objPHPExcel->getActiveSheet()->getCell("A" .$i)->getValue();
                $data['id']       = $objPHPExcel->getActiveSheet()->getCell("B" .$i)->getValue();
                $data['title']    = $objPHPExcel->getActiveSheet()->getCell("C" .$i)->getValue();
                $data['choose_A'] = $objPHPExcel->getActiveSheet()->getCell("D". $i)->getValue();
                $data['choose_B'] = $objPHPExcel->getActiveSheet()->getCell("E". $i)->getValue();
                $data['choose_C'] = $objPHPExcel->getActiveSheet()->getCell("F". $i)->getValue();
                $data['choose_D'] = $objPHPExcel->getActiveSheet()->getCell("G". $i)->getValue();
                $data['answer']   = $objPHPExcel->getActiveSheet()->getCell("H". $i)->getValue();
                $data['explain']  = $objPHPExcel->getActiveSheet()->getCell("I". $i)->getValue();
                //看这里看这里,这个位置写数据库中的表名
                D('question')->add($data);

            }
            $this->success('导入成功!');
        } else {
            $this->error("请选择上传的文件");
        }
    }

    //下载试卷的模板文件
    public  function  download(){

        $file = WORKING_PATH.'/Public/Upload/paperTemplate/testPaper.xlsx';
        //输出文件
        header("Content-type: application/octet-stream");
        header('Content-Disposition: attachment; filename="' . basename( $file.'"'));
        header("Content-Length: ". filesize($file));
        //输出缓冲区
        readfile($file);
    }

}
