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
      axios.get('http://localhost/404blog/backend/php/index.php/Home/Article/index')
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

</style>
