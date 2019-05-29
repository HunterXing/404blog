<template>
  <div class="home">
    <!-- 大海报 -->
     <div class="banner-back-img"
        :style="{backgroundImage: 'url(' + backPic + ')'}">
    </div>
    <!-- 个人头像 -->
    <div class="header-pic">
      <div class="header-img"
        :style="{backgroundImage: 'url(' + headerPic + ')'}">
      </div>
    </div>
    <!-- 个人信息 -->
    <div class="teacher-info">
      <div class="my-info">
        <p class="name">醉墨离</p>
        <p class="school">安徽志辉教育学院</p>
      </div>
      <!-- 个人介绍 -->
      <div class="intr">
        <div class="intr-content">
            作为英语老师，每次给学生们布置口头作业，担心学生不会认真地完成，所以要花大量的时间去检查孩子们的完成情况，要么占用课堂时间，要么占用下课时间，即使这样，依旧有一部分的学生需要“返工”，占用了我大部分时间，非常影响工作效率，浪费时间。
  我也可以对孩子们的语音作业做出纠正和示范，孩子们则可以通过暂停功能来跟读老师的示范语音。
        </div>
      </div>
      <!-- 卡片 -->
      <div class="card-box">
        <div class="cards">
          <div class="card" v-for="(i,index) in 8" :key="index">
            <div class="card-left">
              <div class="iconfont">&#xe611;</div>
            </div>
            <div class="card-right">
              <p class="time">2018-2-6</p>
              <p class="time-title">加入时间</p>
            </div>
          </div>

        </div>
      </div>
      <!-- 学生评课统计 -->
      <div class="course-static">
        <!-- <chart  :options="orgOptions1" :auto-resize="true"></chart> -->
        <div class="pie-box">
          <chart  :options="option" :auto-resize="true" style="width:1000px; height: 450px;"></chart>
        </div>
      </div>
      <!-- 学生出勤率 -->
      <div class="attendance-rate">
        <!-- <chart  :options="orgOptions1" :auto-resize="true"></chart> -->
        <div class="bar-box">
          <chart  :options="option2" :auto-resize="true"></chart>
        </div>
      </div>

    </div>
  </div>
</template>

<script>
// 首先的引入需要用的echart类型
// 折线
import 'echarts/lib/chart/line'
// 饼状图
import 'echarts/lib/chart/pie'
// 柱状图
import 'echarts/lib/chart/bar'
// 提示
import 'echarts/lib/component/tooltip'
// 图例
import 'echarts/lib/component/legend'
// 标题
import 'echarts/lib/component/title'
export default {
  name: 'Home',
  data () {
    return {
      backPic: 'https://www.zhykt.com//ut/static/img/banner.9ccb1486.png',
      headerPic: 'https://ss1.bdstatic.com/70cFuXSh_Q1YnxGkpoWK1HF6hhy/it/u=1411647716,1015660917&fm=26&gp=0.jpg',
      orgOptions1: {},
      option: {},
      option2: {}
    }
  },
  mounted () {

    this.option = {
         title: {
          text: '评课的得分是学生对老师教学的有力肯定',
          x: 'center',
          textStyle: {
            color: '#fff',
            fontSize: 18,
            fontWeight: 'normal'
          }
        },
        tooltip: {
          trigger: 'item',
          formatter: '{a} <br/>{b} : {c} ({d}%)'
        },
        legend: {
          show: true,
          x: 'center',
          bottom: 20,
          data: ['直接访问','邮件营销','联盟广告','视频广告','搜索引擎'],
          textStyle: {
            color: '#fff',
            fontSize: 20
          }
        },
        color: ['#18DBDF', '#F6EF7B', '#3DE16F', '#EF69FB', '#FE5679'],
        calculable: true,
        toolbox: {
            show : true,
            feature : {
                mark : {show: true},
                dataView : {show: true, readOnly: false},
                magicType : {
                    show: true,
                    type: ['pie', 'funnel'],
                    option: {
                        funnel: {
                            x: '25%',
                            width: '50%',
                            funnelAlign: 'left',
                            max: 1548
                        }
                    }
                },
                restore : {show: true},
                saveAsImage : {show: true}
            }
        },
        label: {
          show: true,
          fontSize: 20
        },
        calculable : true,
        series : [
            {
                itemStyle: {
                  normal: {
                    label: {
                      show: true,
                      formatter: '{b} : {c} ({d}%)'
                    },
                    labelLine: {
                      show: true
                    }
                  }
                },
                name:'访问来源',
                type:'pie',
                radius : '55%',
                center: ['50%', '60%'],
                data:[
                    {value:335, name:'直接访问'},
                    {value:310, name:'邮件营销'},
                    {value:234, name:'联盟广告'},
                    {value:135, name:'视频广告'},
                    {value:1548, name:'搜索引擎'}
                ]
            }
        ]
    },
    this.option2 = {
        title : {
            text: '世界人口总量',
            subtext: '数据来自网络'
        },
        tooltip : {
            trigger: 'axis'
        },
        legend: {
            data:['2011年', '2012年']
        },
        toolbox: {
            show : true,
            feature : {
                mark : {show: true},
                dataView : {show: true, readOnly: false},
                magicType: {show: true, type: ['line', 'bar']},
                restore : {show: true},
                saveAsImage : {show: true}
            }
        },
        calculable : true,
        xAxis : [
            {
                type : 'value',
                boundaryGap : [0, 0.01],
                axisLine: {
                    lineStyle: {
                        color: "#fff",
                    }
                }

            }
        ],
        yAxis : [
            {
                type : 'category',
                data : ['巴西','印尼','美国','印度','中国','世界人口(万)'],
                axisLine: {
                    lineStyle: {
                        color: "#fff",
                    }
                }

            }
        ],
        series : [
            {
                name:'2011年',
                type:'bar',
                data:[18203, 23489, 29034, 104970, 131744, 630230]
            },
            {
                name:'2012年',
                type:'bar',
                data:[19325, 23438, 31000, 121594, 134141, 681807]
            }
        ]
    }

  }
}
</script>
<style lang="scss" scoped>
  .banner-back-img {
    width: 100%;
    height: 440px;
    background-size: cover;
    background-position: top center;
  }
  .header-pic {
    text-align: center;
    line-height: 195px;
    .header-img {
      display: inline-block;
      width:195px;
      height:195px;
      border-radius:50%;
      margin-top: -50%;
      background-size: 100% 100%;
      border: 5px solid #fff
    }
  }

  .teacher-info {
    margin-top:-80px;
    .my-info {
      text-align: center;
      font-size:30px;
      font-family:SourceHanSansSC-Regular;
      font-weight:400;
      p {
        padding: 0;
        margin: 5px
      }
  }
  }
  .intr {
    margin-top: 10px;
    text-align: center;
    .intr-content {
      display:inline-block;
      width:40%;
      text-align: left
    }
  }
  .card-box {
    text-align: center;
    margin-top: 20px;
    .cards {
      display: inline-block;
      width: 1250px;
      // border: 1px solid #000;
      .card {
        float: left;
        margin:5px 10px;
        width:285px;
        height:128px;
        background:#F0F0F0;
        border:1px solid #DDDAE6;
        border-radius:6px;
        .card-left {
          float: left;
          width: 40%;
          .iconfont {
            width: 80px;
            font-size: 50px;
            color: #3FA2FF;
            text-align: center;
            line-height: 128px;
          }
        }
        .card-right {
          float: left;
          width: 60%;
          .time{
            color: #3FA2FF;
          }
          .time-title {
            color: #000;
          }
        }
      }
    }
  }
  .course-static {
    margin-top: 20px;
    background: #16569B;
    height: 480px;
    text-align: center;
    .pie-box {
      display: inline-block;
    }
  }
  .attendance-rate {
    background: #013A74;
    height: 480px;
    text-align: center;
    .bar-box {
      display: inline-block;
    }
  }
</style>
