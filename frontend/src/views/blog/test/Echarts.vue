<template>
  <div class="echarts">
      <left-bar></left-bar>
      <div class="contant">
        <el-tabs class="tabs" v-model="activeName" @tab-click="handleClick">
          <el-tab-pane label="用户管理" name="first">
            <div class="container">
              <p> <span class="span-school-analyze">学校分析——</span> <span class="span-school-name"> 这里显示的是学校的名称</span></p>
              <!-- 数据总览 -->
              <el-card class="box-card">
                <div slot="header" class="clearfix">
                  <span>数据总览</span>
                </div>
                <div v-for="o in 8" :key="o" class="card-item" >
                  <div class="div-left"
                    :style="{background:  bgcolor[o-1] }"
                  >
                    <span class="iconfont tab-icons" v-html="icons[o-1]"></span>
                  </div>
                  <div class="div-right">
                    <div class="div-right-top">
                      <span class="number"
                        :style="{color:  bgcolor[o-1] }"
                      >
                        {{numbers[o-1]}}
                      </span>


                    </div>
                    <div class="div-right-bottom">
                       <span class="number-intro">
                        课程数量
                      </span>
                    </div>
                  </div>
                </div>
              </el-card>
              <!-- 登陆人数分析 -->
              <el-card class="box-card-teacher" style="width:48%">
                <div slot="header" class="clearfix">
                  <span>今日登录教师数/教师总人数</span>
                </div>
                <div  class="progress-con">
                  <div class="progress-left">
                    <el-progress type="circle" :percentage="80" color="#8e71c7" :stroke-width="17"></el-progress>
                  </div>
                  <div class="progress-right">

                  </div>
                </div>
              </el-card>

              <el-card class="box-card-student" style="width:48%">
                <div slot="header" class="clearfix">
                  <span>今日登录学生数/学生总人数</span>
                </div>
                <div  class="text item">
                  <el-progress type="circle" :percentage="80" color="#42CC36" stroke-width="17"></el-progress>
                </div>
              </el-card>

            </div>
          </el-tab-pane>
          <el-tab-pane label="配置管理" name="second">配置管理</el-tab-pane>
          <el-tab-pane label="角色管理" name="third">角色管理</el-tab-pane>
          <el-tab-pane label="定时任务补偿" name="fourth">定时任务补偿</el-tab-pane>
        </el-tabs>
      </div>
  </div>
</template>
<script>
import LeftBar from './components/leftBar'
export default {
  name: 'Echarts',
  components: {
    LeftBar
  },
  data() {
    return {
      activeName: 'first',
      bgcolor: [
        '#00BCD5',
        '#0192D5',
        '#E055A6',
        '#F5A623',
        '#A64DF5',
        '#259F94',
        '#925990',
        '#585858',
      ],
      icons: [
        '&#xe60f;',
        '&#xe60e;',
        '&#xe678;',
        '&#xe724;',
        '&#xe62a;',
        '&#xe6b6;',
        '&#xe609;',
        '&#xe604;',
      ],
      numbers: [186,24,3634,1364,263,2235,1567,580],
      strokeWidth: 20
    };
  },
  methods: {
    handleClick(tab, event) {
      console.log(tab, event);
    }
  }
}
</script>
<style lang="scss" scoped>
  .echarts {
    .contant {
      position: absolute;
      top: 0;
      display: inline-block;
      min-height: 1000px;
      width: 96%;
      background: #EDF2F6;
      .tabs {
        .container {
          // border: 1px solid red;
          width: 75%;
          margin: 0 auto;
          p {
            font-size:18px;
            font-family:SourceHanSansSC-Medium;
            font-weight:700;
            line-height:20px;
            .span-school-analyze {
              color: #000;
            }
            .span-school-name {
              color: #3FA2FF
            }
          }
          .box-card {
            .card-item {
              border:1px solid rgba(237,242,246,1);
              height: 100px;
              width: 260px;
              float: left;
              margin: 10px;
              border-radius: 10px;
              display: flex;
              .div-left {
                flex: 1;
                text-align: center;
                line-height: 100px;
                border-radius: 10px 0 0 10px;
                .tab-icons {
                  color: #fff;
                  font-size: 36px;
                }
              }
              .div-right {
                flex: 1;
                .div-right-top {
                  height: 60%;
                  text-align: center;
                  font-size:32px;
                  font-family:SourceHanSansSC-Medium;
                  font-weight:500;
                  color:rgba(0,188,213,1);
                  padding-top: 10px;
                }
                .div-right-bottom {
                  height: 40%;
                  text-align: center;
                  font-size:16px;
                  font-family:SourceHanSansSC-Medium;
                  font-weight:500;
                  color:rgba(51,51,51,1);
                  line-height:20px;
                }
              }
            }
          }
          .box-card-teacher {
            margin: 20px 25px 20px 0;
            float: left;
            .progress-con {
              display: flex;
              .progress-left {
                flex: 1;
              }
              .progress-right {
                flex: 1;
              }
            }
          }
          .box-card-student {
            margin: 20px 0 20px 25px;
            float: right;
          }
        }
      }
    }
  }
   /deep/ .el-tabs__item {
    padding: 0 20px;
    height: 60px;
    -webkit-box-sizing: border-box;
    box-sizing: border-box;
    line-height: 60px;
    display: inline-block;
    list-style: none;
    font-size: 16px;
    font-weight: 500;
    color: #898a8e;
    position: relative;
    width: 125px;
    text-align: center;
  }
  /deep/ .el-tabs__nav-scroll {
    overflow: hidden;
    background: #fff;
  }

  /deep/ .el-card__header {
        padding: 18px 20px;
        border-bottom: 1px solid #EBEEF5;
        -webkit-box-sizing: border-box;
        box-sizing: border-box;
        background: #f7f7f7;
    }
</style>
