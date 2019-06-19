<?php
namespace Home\Controller;
use Think\Controller;
use Think\Verify;
class RegisterController extends Controller {
    public function index(){
        $phone = $_REQUEST['phone'];
        $password = $_REQUEST['password'];
        $code = $_REQUEST['code'];
        // echo $_SESSION['mobileCode'];
        // 如果验证码匹配成功，插入数据
        if($code == $_SESSION['mobileCode'])
        {
            //1.通过数据库验证参数是否存在
            $user = M('user');
            $result = $user->where("phone ='$phone'")->find();
            if($result){
                $datas = array
                    (
                        'message'=>'注册失败用户已存在!'
                    );
                echo json_encode($datas);
            }else{
                //注册成功
                $data['phone'] = $phone;
                $data['password'] = $password;
                $data['join_time'] = date('Y-m-d', time());
                // 产生hash值链接昵称
                $chars = 'ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz0123456789!@#$%^&*()+-';
                $random = $chars[mt_rand(0,73)].$chars[mt_rand(0,73)].$chars[mt_rand(0,73)].$chars[mt_rand(0,73)].$chars[mt_rand(0,73)];
                $content = uniqid().$random;
                $data['nickname'] = '小蜜蜂'.$content;
                $data['signature'] = '这个家伙很懒什么也没留下';
                $data['header_pic'] = 'https://gitee.com/aiits/BeeEdu-img/raw/master/img/mifeng.jpg';
                $data['learn_time'] = 0;
                $data['school'] = '其他学校';
                $data['ep'] = 0;
                $user->data($data)->add();
                // 注册成功后返回信息
                $result = $user -> where("phone = '$phone'") -> find();
                    if ($result) {
                        $datas = array
                        (
                            'id'=>$result['id'],  //用户的id
                            'message'=>'注册成功'
                        );
                        echo json_encode($datas);
                    }
            }
        }else{
            $datas = array
            (
                'message'=>'请输入正确的验证码'
            );
            echo json_encode($datas);
        }
    }
    //发送手机验证码
    public function sendMsg()
    {     
        $phone = $_REQUEST['phone'];
        $phone = (float)$phone;
        // echo $phone;
        $appid = 1400173336;
        $appkey = "ac290ef091add4ce6e8c622f6e92ed04";
        $data['phone'] = $phone;
        $data['templId'] = 256143;//正文模板ID

        //随机验证码
        $rand = rand(0000,9999);
        // echo json_encode($rand);
        //S('mobileCode', $data['phone'] . $rand);//保存session
        $_SESSION['mobileCode'] = $rand;
        try {
            $sender = new \Think\Sms\SmsSingleSender($appid, $appkey);
            $params = [$rand];//变量替换
            $result = $sender->sendWithParam("86", $data['phone'], $data['templId'], $params,"", "", "");
            // dump($result);
            // dump($_SESSION['mobileCode']);
            header('Access-Control-Allow-Origin:*');  
            // 响应类型  
            header('Access-Control-Allow-Methods:*');  
            // 响应头设置  
            header('Access-Control-Allow-Headers:x-requested-with,content-type');
            echo $result;
        } catch(\Exception $e) {
            echo var_dump($e);
        }
    }
}
