<?php
namespace Home\Controller;
use Think\Controller;
use Think\Verify;
class DynamicController extends Controller {
    public function index(){
      // 接受登陆者的id
      $loginid = $_REQUEST['loginid'];
      // echo json_encode($loginid);
      $dynamic = M(dynamic);
      $follow = M(follow);
      // 1.先去查询是否是动态发布者
      $arr = $dynamic->where("user_id = $loginid")->count();
      // 2.查询登录者关注的人的id
      $arr2 = $follow
              ->field('tb_dynamic.user_id')
              ->where("tb_follow.user_id = $loginid")
              ->join('tb_dynamic ON tb_follow.other_uid = tb_dynamic.user_id')
              ->select();
      $arr21 = $follow
              ->field('tb_dynamic.user_id')
              ->where("tb_follow.user_id = $loginid")
              ->join('tb_dynamic ON tb_follow.other_uid = tb_dynamic.user_id')
              ->count();
      $arr22 = json_encode($arr2);
      // 3.定义一个数组去接受要去改变的user_id
      // $datas = array();
      // dump($arr2);
      // dump($arr22);
      for($i = 0; $i < $arr21; $i++)
      {
        $datas[$i] = $arr2[$i]['user_id'];
        // dump($arr2[$i]['dynamic_id']);
      };
      // dump($datas);
      if($arr){
        $data['isfollow'] = '3';
        $dynamic -> where("user_id = $loginid") -> save($data);
        $data2['isfollow'] = '0';
        $dynamic -> where("user_id != $loginid") -> save($data2);
      }
      // 将关注者的信息更改为1
      if($arr21){
        // echo json_encode($arr21);
        // 更改不是关注者的isfollow为0
        for($i = 0; $i < count($datas); $i++){
          // echo json_encode($datas);
          $data2['isfollow'] = '1';
          $dynamic -> where("user_id = $datas[$i]") -> save($data2);
        };
      }
      if(!$arr && !$arr21){
        $data2['isfollow'] = '0';
        $dynamic -> where("1=1") -> save($data2);
      }
      $datas2 = $dynamic
                ->join('tb_user ON tb_dynamic.user_id = tb_user.id')
                ->order('dynamic_id asc')
                ->select();
      echo json_encode($datas2);
    }
    // 添加动态
    public function add(){
      $userid = $_REQUEST['userid'];
      $imgurl = $_REQUEST['imgurl'];
      $dynamicContent = $_REQUEST['dynamicContent'];
      // echo $imgurl;
      // echo $dynamicContent;
      $adddynamic = M(dynamic);
      $data['user_id'] = $userid;
      $data['content'] = $dynamicContent;
      $data['theme'] = '蜜蜂小心情';
      $data['dynamic_img'] = 'data:image/jpeg;base64,'.$imgurl;
      $data['dynamic_time'] = date('Y-m-d H:i', time());
      // echo json_encode($data);
      $result = $adddynamic->add($data);
      if($result){
        $datas = array
          (
            'code'=>200,
            'message'=>'动态发布成功'
          );
        echo json_encode($datas);
      }
    }
    // 点击增加关注
    public function addfollow(){
      $user_id = $_REQUEST['user_id'];
      $other_uid = $_REQUEST['other_uid'];
      $follow = M(follow);
      $data['user_id'] = $user_id;
      $data['other_uid'] = $other_uid;
      $result = $follow->add($data);
      if ($result) {
        $datas = array
        (
          'message'=>'关注成功'
        );
        echo json_encode($datas);
      }
    }
    // 点击取消关注
    public function deletefollow(){
      $user_id = $_REQUEST['user_id'];
      $other_uid = $_REQUEST['other_uid'];
      // dump($user_id);
      // dump($other_uid);
      $follow = M(follow);
      $result = $follow->where("user_id = '$user_id' and other_uid = '$other_uid' ")->delete();
      // dump($result);
      if ($result) {
        $datas = array
        (
          'message'=>'取消关注成功'
        );
        echo json_encode($datas);
      }
    }
}
