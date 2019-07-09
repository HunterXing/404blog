<template>
  <div class="article">
    <article-card :myArticle="myArticle" v-show="myArticle.length"></article-card>
    <div  class="noData-con" v-show="myArticle.length < 0">
      <img src="../../../assets/images/noData.png" alt="">
    </div>
  </div>

</template>

<script>
// import axios from 'axios'
import qs from "qs";
import ArticleCard from "common/Article/ArticleCard";
export default {
  name: "Article",
  components: {
    ArticleCard
  },
  created() {
    // debugger
    this.getRecommend();
  },
  data() {
    return {
      myArticle: []
    };
  },
  methods: {
    getRecommend() {
      // debugger
      this.axios
        .get("/api/blog/list")
        .then(res => {
          console.log(res.data.data);
          this.myArticle = res.data.data
          // debugger
        })
    }
  }
};
</script>

<style lang="stylus" scoped>
  .noData-con
    width 300px
    margin 0px auto
    padding-top 280px
</style>
