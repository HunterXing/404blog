<template>
  <div class="go-top">
    <div class="back-top" @click="goTop" v-show="backTopShow">
      <i class="iconfont top-icon">&#xe66a;</i>
    </div>
  </div>
</template>

<script>
export default {
  name: 'GoTop',
  props: {
    showPx: Number,
    backTopShow: Boolean,
    // backTopAllow: Boolean,
    backSeconds: Number
  },
  methods: {
    goTop () {
      // console.log('hi')
      this.$emit('goTop')
    }
  }
}
</script>

<style lang="stylus" scoped>
  .go-top
    z-index 1000
    .back-top
      position fixed
      bottom 100px
      right 30px
      // border 1px solid #999
      text-align center
      color #999
      .top-icon
        font-size 30px
    .back-top :hover
      color #009a61
</style>
