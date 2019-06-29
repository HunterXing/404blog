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
      <el-tag type="success">1.5k+浏览</el-tag>
      <span class="create-time">2019-6-29 15:42</span>
      <el-button  type="success" size="small" plain class="edit-button fr">编辑</el-button>
      <el-button type="danger" size="small" plain class="fr">删除</el-button>

      <div v-html="article"></div>
    </div>
    <!-- <el-backtop target=".article-title-con " :bottom="100">
      <div
        style="{
            height: 100%;
            width: 100%;
            background-color: #f2f5f6;
            box-shadow: 0 0 6px rgba(0,0,0, .12);
            text-align: center;
            line-height: 40px;
            color: #1989fa;
          }"
      >sdfesdrgsergsergse</div>
    </el-backtop>-->
    <!-- 自己定义的返回顶部组件 -->
    <go-top @goTop="goTop" :backTopShow="backTopShow" :backSeconds="backSeconds" :showPx="showPx"></go-top>
  </div>
</template>

<script>
import MyHeader from "common/header/MyHeader.vue";
import GoTop from "common/goTop/GoTop";
export default {
  name: "ArticleDtail",
  components: {
    MyHeader,
    GoTop
  },
  data() {
    return {
      article: "",
      // 是否显示回到顶部
      backTopShow: false,
      // // 是否允许操作返回顶部
      backTopAllow: true,
      // 返回顶部所需时间
      backSeconds: 100,
      // 往下滑动多少显示返回顶部（单位：px)
      showPx: 100
    };
  },
  methods: {
    getApi() {
      this.axios
        .get("/phpApi/Home/Article/index")
        .then(res => {
          // console.log(res.data[0].content);
          this.article = res.data[0].content;
        })
        .catch(function(err) {
          console.log(err);
        });
    },
    // 返回顶部的显示与隐藏操作
    backTopShowOperate() {
      // TMD页面被卷起的距离
      let marginTop =
        document.documentElement.scrollTop || document.body.scrollTop;
      // console.log(marginTop);
      if (this.backTopAllow) {
        if (marginTop > this.showPx) {
          this.backTopShow = true;
        } else {
          this.backTopShow = false;
        }
      }
    },
    // 点击返回顶部的操作
    goTop() {
      // console.log()
      // let marginTop = document.documentElement.scrollTop || document.body.scrollTop
      // console.log(marginTop)
      if (this.backTopAllow) {
        var step = document.documentElement.scrollTop / this.backSeconds;
        var backTopInterval = setInterval(function() {
          if (document.documentElement.scrollTop > 0) {
            document.documentElement.scrollTop -= step;
          } else {
            this.backTopAllow = true;
            clearInterval(backTopInterval);
          }
        }, 5);
        // this.backTopAllow = false
      }
    }
  },
  mounted() {
    this.getApi();
    window.addEventListener("scroll", this.backTopShowOperate, true);
  }
};
</script>

<style lang="stylus" scoped>
.article {
  position: relative;

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
      height: 60px;
      line-height: 60px;
      margin: 30px 0 20px;

      .article-title {
        padding-left: 10px;
        font-size: 40px;
        font-weight: 700;
      }
    }

    .create-time {
      margin-left: 10px;
      color: #bbb;
    }
    .edit-button {
      margin: 0 10px;
    }
  }
}
</style>
