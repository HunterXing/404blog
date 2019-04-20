<template>
  <div class="home">
    <my-header></my-header>
    <div class="content">

    </div>
    <my-footer></my-footer>
    <go-top
      @goTop="goTop"
      :backTopShow="backTopShow"
      :backTopAllow="backTopAllow"
      :backSeconds="backSeconds"
      :showPx="showPx"
    ></go-top>
  </div>
</template>

<script>
import MyHeader from 'common/header/MyHeader'
import MyFooter from 'common/footer/MyFooter'
import GoTop from 'common/goTop/GoTop'
export default {
  name: 'Home',
  components: {
    MyHeader,
    MyFooter,
    GoTop
  },
  data () {
    return {
      // 是否显示回到顶部
      backTopShow: false,
      // 是否允许操作返回顶部
      backTopAllow: true,
      // 返回顶部所需时间
      backSeconds: 100,
      // 往下滑动多少显示返回顶部（单位：px)
      showPx: 200
    }
  },
  methods: {
    backTopShowOperate () {
      // TMD页面被卷起的距离
      let marginTop = document.documentElement.scrollTop || document.body.scrollTop
      // console.log(marginTop)
      if (!this.backTopAllow) { return }
      if (marginTop > this.showPx) {
        this.backTopShow = true
      } else {
        this.backTopShow = false
      }
    },
    goTop () {
      // console.log(value)
      if (!this.backTopAllow) { return }
      this.backTopAllow = false
      var step = document.body.scrollTop / this.backSeconds
      var backTopInterval = setInterval(function () {
        if (document.body.scrollTop > 0) {
          document.body.scrollTop -= step
        } else {
          this.backTopAllow = true
          clearInterval(backTopInterval)
        }
      }, 1)
    }
  },
  mounted () {
    window.addEventListener('scroll', this.backTopShowOperate, true)
  }
}
</script>

<style lang="stylus" scoped>
  .home
    .content
      min-height 1000px
</style>
