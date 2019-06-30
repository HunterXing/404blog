<template>
  <div class="article">
    <article-card :myArticle="myArticle" v-if="myArticle.length"></article-card>
    <div  class="noData-con" v-else>
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
  mounted() {
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
        .post("/phpApi/Home/Article/getRecommend")
        .then(res => {
          console.log(res);
          let code = res.data.code;
          if (code > 0) {
            let message = res.data.message;
            this.myArticle = res.data.result;
          } else {
            this.$message({
              type: "error",
              message: message
            });
          }
        })
        .catch(error => {
          console.log(error);
        });
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
