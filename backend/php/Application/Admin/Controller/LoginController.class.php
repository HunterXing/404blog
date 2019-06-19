<?php
namespace Admin\Controller;
use Think\Controller;
use Think\Verify;
class LoginController extends Controller {
    public function getVerify()
    {
        $config = array(
            'fontSize'=>16,//验证码字体
            'length'=>4,//验证码个数
            'useNoise'=>false,//关闭验证码杂点
            'codeSet' => '0123456789'//设置为数字
        );
        ob_clean();
        $Verify = new Verify($config);
        $Verify->entry();
    }
    //教师登录界面
    public function index(){
        if(IS_POST){
            $post = I('post.');
            $captcha = $post['code'];//验证码
            $account = $post['username'];//账户
            $password = $post['password'];//密码
            $userInfo = M('teacher')->where("account = '$account' ")->find();
            //1.实例化验证码类
            ob_clean();
            $verfiy = new  Verify();
            $result = $verfiy->check($captcha);
            //dump($result);die;
            if($result){//验证码正确
                $model = M('teacher');
                $result = $model ->where("account = '$account' and password = '$password' ")-> find();
                if($result){
                    session('name',$post['username']);
                    session('role',$userInfo['role']);
                    $this->redirect('Admin/index');
                }else{
                    $this ->error('用户名或密码错误');
                }
            }else{
                $this -> error('验证码错误');
            }
        }else{
            $this->display();
        }
    }
}
