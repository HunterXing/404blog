//前台校验验证码正确性
$("#lo-account").blur(function() {
    var phone =document.getElementById('lo-account').value;
    if ((/^1[34578]\d{9}$/.test(phone))) {
        $("#show_code").css('display','none');
    }else {
        $("#show_code").css('display','block');
    }
});

function sendMessage() {
    var phone =document.getElementById('lo-account').value;
    $.ajax({
        type: "POST", // 用POST方式传输
        dataType: "text", // 数据格式:JSON
        url: "sendMsg", // 目标地址
        data: {
            phone: phone ,
        },
        success: function (data){
            datas = JSON.parse(data);
            str = JSON.parse(datas);//需要两次解析
            // console.log(str);
            if(str.result == 0 && str.errmsg =="OK"){
                console.log(123);
                $("#getcodeMsg").css('display','none');
                $("#showtime").css('display','block');
                setInterval("CountDown()", 1000);
            }
        },
        error: function (data) {
            console.log(data);
        }
    });

}
//timer处理函数
var maxtime = 2*60; //三分钟，按秒计算，自己调整!
function CountDown() {
    if (maxtime >= 0) {
        document.getElementById("showtime").innerHTML =maxtime;
        --maxtime;
    } else{
        clearInterval(showtime);
        document.getElementById("showtime").innerHTML =null;
        $("#showtime").css('display','none');
        $("#getcodeMsg").css('display','block');
        // alert("时间到，结束!");
    }
}


//验证短信验证码
// function doCompare(){
//     var codelast = document.getElementById("codelast").value;//获取输入的验证码
//     if(codelast == null || codelast == ''){ alert("验证码不能为空！");
//     }else{
//         $.ajax({ type: "POST", // 用POST方式传输
//             dataType: "text", // 数据格式:JSON
//             url: "forgetPasswdServlet", // 目标地址
//             data: "flag=4&codelast="+codelast,
//             success: function (data){ data = parseInt(data, 10);
//                 if(data == 1){ window.location.href='/aoyi/forgetpasswd/forgetpasswd3.jsp';//验证成功
//                 }else if(data == 0){
//                     $("#jbPhoneTip").html("<font color='red'>×短信验证码不正确请重新输入</font>");
//                 }else if(data ==2){
//                     $("#jbPhoneTip").html("<font color='red'>×验证码已失效请重新获取验证码</font>"); } } });
//     } }
