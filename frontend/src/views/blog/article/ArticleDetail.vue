<template>
  <div class="article-detail markdown-body">
    <div v-html="article">

    </div>
  </div>
</template>

<script>
// import axios from 'axios'
// import 'style/markdown.css'
import "mavon-editor/dist/css/index.css"
export default {
  name: 'ArticleDtail',
  methods: {
    getApi () {
      this.axios.get('http://localhost/404blog/backend/php/index.php/Home/Article/index')
        .then(res => {
          console.log(res.data[0].content)
          this.article = res.data[0].content
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
  // @import "~style/markdown.styl";
    .article-detail
      width 60%
      margin 0 auto
</style>
