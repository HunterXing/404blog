<template>
  <div class="article">
    <my-header></my-header>
    <div class="article-detail markdown-body">
      <div class="article-title-con">
        <span class="article-title">{{articleDetail.title}}</span>
      </div>
      <el-tag v-if="articleDetail.type === 0 ">原创</el-tag>
      <el-tag v-else>转载自 {{articleDetail.link}}</el-tag>
      <el-tag type="info">作者：{{articleDetail.username}}</el-tag>
      <el-tag type="success">{{articleDetail.preview}} 浏览</el-tag>
      <span class="create-time">{{articleDetail.createtime}}</span>
      <!-- 是本文章的作者才能进行编辑和删除 -->
      <div class="fr" v-if="articleDetail.id === auth.id">
        <el-button
          type="success"
          size="small"
          plain
          class="edit-button fr"
          @click.native="toEdit"
        >编辑</el-button>
        <el-button type="danger" size="small" plain class="fr" @click.native="handleDel">删除</el-button>
      </div>

      <div v-html="articleDetail.content" class="article-content"></div>
    </div>
    <!-- 自己定义的返回顶部组件 -->
    <go-top @goTop="goTop" :backTopShow="backTopShow" :backSeconds="backSeconds" :showPx="showPx"></go-top>
  </div>
</template>

<script>
import MyHeader from "common/header/MyHeader.vue";
import GoTop from "common/goTop/GoTop";
import qs from "qs";
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
      showPx: 100,
      articleDetail: {}
    };
  },
  methods: {
    getData() {
      this.axios
        .post(
          "/api/blog/detail",
          qs.stringify({
            blogId: this.$route.params.blogId
          })
        )
        .then(res => {
          console.log(res);
          let code = res.data.errno;
          // let message = res.data.message;

          console.log(res.data.data)
          if (code >= 0) {
            this.articleDetail = res.data.data;
            // debugger
            let blogId = res.data.blogId;
            console.log(res.data.blogId)
            // this.$message({
            //   type: "success",
            //   message: message
            // });
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
    },

    // 删除文章提示
    handleDel() {
      this.$confirm("此操作将删除该博客, 是否继续?", "提示", {
        confirmButtonText: "确定",
        cancelButtonText: "取消",
        type: "warning"
      })
        .then(() => {
          this.doDel();
        })
        .catch(() => {
          this.$message({
            type: "info",
            message: "已取消删除"
          });
        });
    },
    // 删除
    doDel() {
      this.axios
        .post(
          "/api/blog/delArticle",
          qs.stringify({
            blogId: this.$route.params.blogId
          })
        )
        .then(res => {
          console.log(res);
          let code = res.data.errno;
          let message = res.data.message;
          if (code === 0) {
            this.goHome();
            this.$message({
              type: "success",
              message: message
            });
          }
        })
        .catch(error => {
          console.log(error);
        });
    },
    // 添加访问量
    addPageView() {
      this.axios
        .post(
          "/api/blog/addview",
          qs.stringify({
            blogId: this.$route.params.blogId,
          })
        )
        .then(res => {
          console.log(res);
        })
        .catch(error => {
          console.log(error);
        });
    },
    // 返回我的文章
    goHome() {
      setTimeout(() => {
        this.$router.push({
          name: "Article"
        });
      }, 1500);
    },
    // 去编辑文章
    toEdit() {
      this.$router.push({
        name: "Write",
        params: {
          blogId: this.$route.params.blogId
        }
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
    this.getData();
    this.addPageView();
    window.addEventListener("scroll", this.backTopShowOperate, true);
    this.$store.dispatch("loginCheck");
  },
  computed: {
    auth() {
      return this.$store.state.auth;
    }
  }
};
</script>

<style lang="scss" scoped>
.article {
  position: relative;

  .article-detail {
    // width: 60%;
    // margin: 20px auto;

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

    .article-content {
      margin-top: 50px;
    }
  }
}


@media only screen and( max-width:960px) {
  // 当屏幕宽度小于960时 认为是移动端
  .article-detail {
    width: 90%;
    margin: 20px auto;
  }
}
@media only screen and( min-width:960px) {
  // 当屏幕宽度大于960时 认为是PC端
  .article-detail {
    width: 60%;
    margin: 20px auto;
  }
}
</style>
