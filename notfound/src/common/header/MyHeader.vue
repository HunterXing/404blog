<template>
  <div class="m-header">
    <!-- logo标志 -->
    <div class="left-logo">
      <img src="../../assets/logo.png">
    </div>
    <!-- tab 集合 -->
    <!-- 首页 -->
    <div class="first">
      首页
    </div>
    <!-- 推荐 -->
    <div class="recomment">
      <i class="iconfont hot">&#xe634;</i> 推荐
    </div>
    <!-- 我的文章 -->
    <div class="my-article">
      <i class="el-icon-tickets"></i>  文章
    </div>
    <!--  标签-->
    <div class="tags"></div>
    <!-- 搜索栏 -->
    <div class="right-search"></div>
    <!-- 个人信息区域 -->
    <div class="message-box">
      <span class="el-icon-message message-icon"></span>
    </div>
    <!-- 写文章 -->
    <div class="write">
      <el-button type="info" plain>写文章</el-button>
    </div>
    <!-- 头像 -->
    <div class="header-box">
      <img :src="headerPic" class="header-pic">
    </div>
  </div>

</template>

<script>
export default {
  name: 'MyHeader',
  data () {
    return {
      headerPic: 'https://avatar-static.segmentfault.com/421/904/4219049238-5c96fb0fef7e6_huge256'
    }
  },
  methods: {

  }

}
</script>

<style lang="stylus" scoped>
.m-header
  height 50px
  line-height 50px
  border-top 3px solid #009a61
  box-shadow: 0px 2px 10px 0px rgba(0,0,0,0.1), 0 1px rgba(0,0,0,0.1)
  background: #fafafa
  z-index: 3
  display flex
  .left-logo
    flex 6
    line-height 60px
    padding-left 50px
    border-radius 10px
    img
      width 180px
  .left-logo :hover
    border-radius 10px
    border 0.5px dashed #009a61
    box-shadow: 0px 0px 10px 0px rgba(0,0,0,0.1), 0 0px rgba(0,0,0,0.1)
  .first, .recomment, .my-article, .tags
    flex 2
  .right-search
    flex 6
  .message-box
    flex 1
    margin 0 10px
    .message-icon
      color #888
      font-size 25px
      padding 2px 10px
  .write
    flex 2
  .header-box
    flex 5
    display inline-block
    height 50px
    line-height 65px
    text-align left
    padding 0 0 0 20px
    img
      width 25px
      height 25px
      border-radius 20px
      border 0.5px dashed #009a61
</style>
