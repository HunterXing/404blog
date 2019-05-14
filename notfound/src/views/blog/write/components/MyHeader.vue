<template>
  <div class="m-header">
    <!-- logo标志 -->
    <router-link tag="div" :to="{name: 'Home'}" class="left-logo">
      <img src="https://raw.githubusercontent.com/HunterXing/resourse/master/images/BlogLogo.png
">
    </router-link>
    <!-- 写文章 -->
    <div class="save">
      <el-button type="success">保存文章</el-button>
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
    inputClick () {
      console.log(this.$refs.search.style.width)
      // this.$refs.search
    }
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
  min-width 1200px
  .left-logo
    flex 10
    line-height 60px
    padding-left 50px
    border-radius 10px
    img
      width 180px
  .left-logo :hover
    border-radius 10px
    border 0.5px dashed #009a61
    box-shadow: 0px 0px 10px 0px rgba(0,0,0,0.1), 0 0px rgba(0,0,0,0.1)

  .save
    flex 1

</style>
