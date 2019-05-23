<template>
  <div class="echarts">
      <left-bar></left-bar>
      <div class="contant">
        <div class="tabs"></div>
        <el-tabs class="tabs" v-model="activeName" @tab-click="handleClick">
          <el-tab-pane label="用户管理" name="first">用户管理</el-tab-pane>
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
      activeName: 'first'
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
      .tabs {
        display: inline-block;
      }
    }
  }
   /deep/ .el-tabs__item {
    padding: 0 20px;
    height: 50px;
    -webkit-box-sizing: border-box;
    box-sizing: border-box;
    line-height: 40px;
    display: inline-block;
    list-style: none;
    font-size: 14px;
    font-weight: 500;
    color: #898a8e;
    position: relative;
    width: 125px;
    text-align: center;
  }
</style>
