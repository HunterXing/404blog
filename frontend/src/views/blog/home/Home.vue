<template>
  <div class="home">
    <div class="content">
      <article-card></article-card>
    </div>
  </div>
</template>

<script>
import ArticleCard from './components/ArticleCard'
export default {
  name: 'Home',
  components: {
    ArticleCard
  },
  data () {
    return {

    }
  }
}
</script>

<style lang="scss" scoped>

</style>
