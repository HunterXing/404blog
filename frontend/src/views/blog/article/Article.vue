<template>
  <div class="article">
    <article-card
      :myArticle="myArticle"
      v-if="myArticle.length > 0"
    ></article-card>
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
  mounted () {
   this.getMyArticle()
  },
  data () {
    return {
      myArticle: []
    }
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
    // 得到自己所有的文章
    getMyArticle() {
      // debugger
      this.axios
        .post(
          "/phpApi/Home/Article/getMyArticle",
          qs.stringify({
            userId: this.$store.state.userId
          })
        )
        .then(res => {
          console.log(res);
          let code = res.data.code;
          if (code > 0) {

            let message = res.data.message;
            this.myArticle = res.data.result;

          } else {
            this.$message({
              type: 'error',
              message: message
            })
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
