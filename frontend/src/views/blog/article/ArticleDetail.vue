<template>
  <div class="article">
    <my-header></my-header>
    <div class="article-detail markdown-body">
      <!-- <div class="author-info-con clearfix">
        <img  class="fl header-pic" src="https://avatar-static.segmentfault.com/421/904/4219049238-5c96fb0fef7e6_big64" alt="">
        <div class="fl">
          <div class="top">

          </div>
          <div class="bottom">

          </div>
        </div>
      </div>-->
      <div class="article-title-con">
        <span class="article-title">这是文章标题</span>
      </div>
      <el-tag>原创</el-tag>
      <el-tag type="info">作者名</el-tag>
      <span class="create-time">2019-6-29 15:42</span>
      <el-button type="success" size="small" plain class="fr">编辑</el-button>
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

  .author-info-con {
    margin: 20px 0;
    height: 80px;
    line-height: 80px;

    .header-pic {
      display: inline-block;
      width: 40px;
      height: 40px;
      overflow: hidden;
    }
  }

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

  .create-time {
    margin-left 10px;
    color: #bbb;
  }
}
</style>
