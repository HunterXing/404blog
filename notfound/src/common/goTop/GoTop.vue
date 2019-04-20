<template>
  <div class="go-top">
    <div class="back-top" @click="goTop" v-show="backTopShow">
      <i class="el-icon-caret-top"></i>
    </div>
  </div>
</template>

<script>
export default {
  name: 'GoTop',
  props: {
    showPx: Number,
    backTopShow: Boolean,
    backTopAllow: Boolean,
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
      border 1px solid #999
      text-align center
      font-size 12px
      color #999
    .back-top :hover
      background #999
</style>
