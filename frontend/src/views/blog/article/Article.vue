<template>
  <div class="article">
    <article-card :myArticle="myArticle" v-if="myArticle.length > 0"></article-card>
    <div class="noData-con" v-else>
      <img src="../../../assets/images/noData.png" alt />
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
    this.getMyArticle();
  },
  activated () {
    this.getMyArticle();
  },
  data() {
    return {
      myArticle: []
    };
  },
  methods: {
    getMyArticle() {
      // debugger
      this.axios
        .post(
          "/api/blog/getMyArticle",
        )
        .then(res => {
          console.log(res);
          let code = res.data.errno;
          if (code ===  0) {
            // let message = res.data.message;
            this.myArticle = res.data.data;
          }
        })
        .catch(error => {
          console.log(error);
        });
    }
  }
};
</script>

<style lang="scss" scoped>
@media only screen and( max-width:960px) {
  // 当屏幕宽度小于960时 认为是移动端
  .noData-con {
    width: 300px;
    margin: 0px auto;
    padding-top: 130px;
  }
}

// PC端
@media only screen and( min-width:960px) {
   .noData-con {
    width: 300px;
    margin: 0px auto;
    padding-top: 280px;
  }
}
</style>
