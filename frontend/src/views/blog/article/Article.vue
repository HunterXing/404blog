<template>
  <div class="article">
    <ul v-infinite-scroll="load">
      <article-card></article-card>
    </ul>
  </div>
</template>

<script>
// import axios from 'axios'
import ArticleCard from 'common/Article/ArticleCard'
export default {
  name: 'Article',
  components: {
    ArticleCard
  },
  methods: {
    // getApi () {
    //   axios.get('http://212.64.25.152:5000/test')
    //     .then(function (res) {
    //       console.log(res)
    //     })
    //     .catch(function (err) {
    //       console.log(err)
    //     })
    // }
  }
  // mounted () {
  //   this.getApi()
  // }
}
</script>

<style lang="stylus" scoped>

</style>
