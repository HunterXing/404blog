<template>
  <div class="article">
    文章
  </div>
</template>

<script>
import axios from 'axios'
export default {
  name: 'Article',
  methods: {
    getApi () {
      axios.get('http://212.64.25.152:5000/test')
        .then(function (res) {
          console.log(res)
        })
        .catch(function (err) {
          console.log(err)
        })
    }
  },
  mounted () {
    this.getApi()
  }
}
</script>

<style lang="stylus" scoped>

</style>
