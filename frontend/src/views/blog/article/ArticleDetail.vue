<template>
  <div class="article">
    <my-header></my-header>
    <div class="article-detail markdown-body">
      <!-- <div class="author-info-con">

      </div>-->
      <div class="article-title-con">
        <span class="article-title">这是文章标题</span>
      </div>
      <el-tag>原创</el-tag>

      <div v-html="article"></div>
    </div>
  </div>
</template>

<script>
import MyHeader from "common/header/MyHeader.vue";
export default {
  name: "ArticleDtail",
  components: {
    MyHeader
  },
  methods: {
    getApi() {
      this.axios
        .get(
          "http://localhost/404blog/backend/php/index.php/Home/Article/index"
        )
        .then(res => {
          console.log(res.data[0].content);
          this.article = res.data[0].content;
        })
        .catch(function(err) {
          console.log(err);
        });
    }
  },
  mounted() {
    this.getApi();
  },
  data() {
    return {
      article: ""
    };
  }
};
</script>

<style lang="stylus" scoped>
.article-detail {
  width: 60%;
  margin: 20px auto;

  .article-title-con {
    border-left: 8px solid #5cb85c;
    height: 80px;
    line-height: 80px;
    margin: 30px 0 20px;

    .article-title {
      padding-left: 10px;
      font-size: 50px;
      font-weight: 700;
    }
  }
}
</style>
