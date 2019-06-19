<?php
namespace  Home\Model;
use Think\Model;

class UserModel extends Model{ 
    // updateData
    public function updateData($post,$file){
        //如果有文件则处理文件
        if($file['error'] == '0'){//有文件
            $cfg = array(
                'rootPath'      => WORKING_PATH.UPLOAD_ROOT_PATH
            );
            //实例化上传类
            $upload = new\Think\Upload($cfg);
            //上传
            $info = $upload -> uploadOne($file);
            //dump($info);die;
            if($info){
                $post['header_pic'] = 'http://localhost/api/'.UPLOAD_ROOT_PATH.$info['savepath'].$info['savename'];
            }
        }
        //dump($post);die;
        //没文件  写入数据
        return $this -> save($post);
    }
}