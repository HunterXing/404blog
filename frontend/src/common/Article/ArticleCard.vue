<template>
  <div class="aiticle-card">
    <div class="content">
      <el-card
        class="box-card"
        shadow="hover"
        v-for="(item) in articleSimple"
        :key="item.id"
        @click.native="getDetail(item.id)"
      >
        <!-- 左边 -->
        <div class="left-con">
          <div class="pic" :style="{backgroundImage: 'url(' + (item.articlePic) + ')'}"></div>
          <p>
            <span class="p-create-time">创建时间：</span>
            <span class="span-time">{{item.createTime}}</span>
          </p>
          <span class="p-read-number">有{{item.peoNumber}}人阅读过该文章</span>
        </div>
        <!--右边-->
        <div class="right-con">
          <div class="article-titie">
            <!-- <span>No1.</span>
            制作一个简单的菜单动画效果-->
            {{item.title}}
          </div>
          <div class="article-author">
            <i class="iconfont">&#xe654;</i>
            {{item.author}} |
            <i class="iconfont">&#xe612;</i>
            {{item.job}}
          </div>
          <div class="article-content">{{item.articleBrief}}</div>
          <!-- 标签 -->
          <div class="tags-con">
            <el-tag>标签一</el-tag>
            <el-tag type="success">标签二</el-tag>
            <el-tag type="info">标签三</el-tag>
            <el-tag type="warning">标签四</el-tag>
            <el-tag type="danger">标签五</el-tag>
          </div>
        </div>
      </el-card>
    </div>
  </div>
</template>

<script>
import axios from "axios";
export default {
  name: "AiticleCard",
  data() {
    return {
      articleSimple: []
    };
  },
  methods: {
    getArtical() {
      axios
        .get("http://localhost:8080/static/mock/data.json")
        .then(res => {
          console.log(res);
          this.articleSimple = res.data.data;
        })
        .catch(err => {
          console.log(err);
        });
    },

    getDetail(id) {
      console.log(id)
      this.$router.push(
        {
          name: "ArticleDetail",
          params: {
            blogId: id
          }
        });
    }
  },
  mounted() {
    this.getArtical();
  }
};
</script>

<style lang="scss" scoped>
.aiticle-card {
  .content {
    margin: 0 20px;
    text-align: center;
    .box-card {
      display: inline-block;
      margin-top: 50px;
      width: 1000px;
      height: 345px;
      .left-con {
        height: 100%;
        width: 40%;
        text-align: left;
        float: left;
        .pic {
          height: 214px;
          width: 379px;
          background-repeat: no-repeat;
          background-size: cover;
        }
        p {
          .p-create-time {
            font-size: 14px;
            color: #2d2d2d;
          }
          .span-time {
            font-size: 14px;
            color: #2d2d2d;
            opacity: 0.7;
          }
        }
        .p-read-number {
          font-size: 14px;
          color: #2d2d2d;
          opacity: 0.7;
        }
      }
      .right-con {
        text-align: left;
        float: right;
        height: 100%;
        width: 55%;
        .article-titie {
          font-size: 20px;
          color: #262626;
        }
        .article-author {
          margin-top: 10px;
          color: #38ba72;
        }
        .article-content {
          margin-top: 20px;
          font-size: 15px;
          display: -webkit-box;
          -webkit-line-clamp: 5;
          -webkit-box-orient: vertical;
          overflow: hidden;
          line-height: 1.8;
        }
        .tags-con {
          margin-top: 50px;
        }
      }
    }
  }
}
</style>
