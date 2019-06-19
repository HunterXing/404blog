<template>
  <div class="article-detail">
    <div v-html="article">

    </div>
  </div>
</template>

<script>
import axios from 'axios'
export default {
  name: 'ArticleDtail',
  methods: {
    getApi () {
      axios.get('http://localhost:8080/static/mock/article.json')
        .then(res => {
          console.log(res.data.code)
          this.article = res.data.data[0].articleTitle
        })
        .catch(function (err) {
          console.log(err)
        })
    }
  },
  mounted () {
    this.getApi()
  },
  data () {
    return {
      article: ''
    }
  }
}
</script>

<style lang="stylus" scoped>

</style>
