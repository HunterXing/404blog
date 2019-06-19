$(document).ready(function(){
    $(".j-floor").click(function(){
        $(".j-floor").removeClass("pitch"),
            $(this).addClass("pitch"),//增加选择的属性
            $(".j-con").css("display","none");//将div设置为不可见
            var e = $(this).data("title");//获取当前鼠标点击的div的data_title
            "playback" == e ? $("#j-catalog-live").show() : "live" == e ? $("#j-catalog-playback").show() : "exam" == e && $("#j-exam").show()
    });
    //使用echarts图表
// 基于准备好的dom，初始化echarts实例
    var myChart = echarts.init(document.getElementById('Chart'));
    var myChart1 = echarts.init(document.getElementById('Chart1'));
    var myChart2 = echarts.init(document.getElementById('Chart2'));
// 指定图表的配置项和数据
    var option =  {
        series: [
            {
                name:'访问来源',
                type:'pie',
                radius: ['50%', '70%'],
                avoidLabelOverlap: false,
                // hoverAnimation: false,//设置移动无特效
                // silent:true,
                label: {
                    normal: {
                        show: false,
                        position: 'center',
                        textStyle: {
                            fontSize: '10',
                            fontWeight: 'green'
                        }
                    },
                    emphasis: {
                        show: true,
                        textStyle: {
                            fontSize: '10',
                            fontWeight: 'bold'
                        }
                    }
                },
                labelLine: {
                    normal: {
                        show: false
                    }
                },
                data:[
                    {value:435, name:'已学5.6%',itemStyle: {color: '#6FD321'}},
                    {value:210, name:'未完成94.4',itemStyle: {color: '#F9F9F9'}},
                ]
            }
        ]
    };
    var option1 = {
        series: [
            {
                name:'访问来源',
                type:'pie',
                radius: ['50%', '70%'],
                avoidLabelOverlap: false,
                label: {
                    normal: {
                        show: false,
                        position: 'center',
                    },
                    emphasis: {
                        show: true,
                        textStyle: {
                            fontSize: '10',
                            fontWeight: 'bold'
                        }
                    }
                },
                labelLine: {
                    normal: {
                        show: false
                    }
                },
                data:[
                    {value:810, name:'已授30.2%',itemStyle: {color: '#FFD007'}},
                    {value:134, name:'未授69.8',itemStyle: {color: '#F9F9F9'}},
                ]
            }
        ]
    };
    var option2 = {
        series: [
            {
                name:'访问来源',
                type:'pie',
                radius: ['50%', '70%'],
                avoidLabelOverlap: false,
                label: {
                    normal: {
                        show: false,
                        position: 'center',
                    },
                    emphasis: {
                        show: true,
                        textStyle: {
                            fontSize: '10',
                            fontWeight: 'bold'
                        }
                    }
                },
                labelLine: {
                    normal: {
                        show: false
                    }
                },
                data:[
                    {value:234, name:'平均3.2%',itemStyle: {color: '#9AA1AC'}},
                    {value:835, name:'已学5.6%',itemStyle: {color: '#F9F9F9'}},
                ]
            }
        ]
    };
// 使用刚指定的配置项和数据显示图表。
    myChart.setOption(option);
    myChart1.setOption(option1);
    myChart2.setOption(option2);
});
