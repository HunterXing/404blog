<template>
  <div class="article">
    <div class="test"
      v-for="(item, index) in myData" :key="index"
      @click="hidden(index)"
      v-show="item.isShow"
    >
      {{item.divName}}
    </div>
  </div>
</template>

<script>
export default {
  name: 'Recommend',
  data () {
    return {
      myData: [{
        divName: 'div1',
        isShow: true
      },{
        divName: 'div2',
        isShow: true
      },{
        divName: 'div3',
        isShow: true
      }]
    }
  },
  methods: {
    hidden (index) {
      for (let i in this.myData) {
        this.myData[i].isShow = true
      }

      this.myData[index].isShow = false
    }
  }
}
</script>


<style lang="stylus" scoped>
  .test {
    border 1px solid #f00
    margin 20px
    width 20%
    height 50px
  }
</style>
