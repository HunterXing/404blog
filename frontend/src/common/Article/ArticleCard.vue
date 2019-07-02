<template>
  <div class="aritcle-list-con">
    <!-- PC端 -->
    <div class="pc-show">
      <div class="aiticle-card">
        <div class="content">
          <el-card
            class="box-card"
            shadow="hover"
            v-for="(item) in myArticle"
            :key="item.articleid"
            @click.native="getDetail(item.articleid)"
          >
            <!-- 左边 -->
            <div class="left-con">
              <div
                class="pic"
                :style="{backgroundImage: 'url(' + (articlePic[randomNum(0,2)]) + ')'}"
              ></div>
              <p>
                <span class="p-create-time">创建时间：</span>
                <span class="span-time">{{item.createtime}}</span>
              </p>
              <span class="p-read-number">有{{item.preview}}人阅读过该文章</span>
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
                {{item.username}} |
                <i class="iconfont">&#xe612;</i>
                {{item.job}}
              </div>
              <div class="article-content">{{item.markdown}}</div>
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
        <div class="u-page-con">
          <el-pagination
            @size-change="handleSizeChange"
            @current-change="handleCurrentChange"
            :current-page="currentPage"
            :page-sizes="[5, 10, 15, 20]"
            :page-size="pageSize"
            layout="total, sizes, prev, pager, next, jumper"
            :total="myArticle.length"
          ></el-pagination>
        </div>
      </div>
    </div>
    <!-- 移动端 -->
    <div class="phone-show">
      <div class="aiticle-card">
        <div class="content">
          <el-card
            class="box-card"
            shadow="hover"
            v-for="(item) in myArticle"
            :key="item.articleid"
            @click.native="getDetail(item.articleid)"
          >
            <div class="article-titie">{{item.title}}</div>
            <p>
              <span class="p-create-time">创建时间：</span>
              <span class="span-time">{{item.createtime}}</span>
            </p>
            <span class="p-read-number">有{{item.preview}}人阅读过该文章</span>

            <div class="article-author">
              <i class="iconfont">&#xe654;</i>
              {{item.username}} |
              <i class="iconfont">&#xe612;</i>
              {{item.job}}
            </div>
            <!--右边-->
          </el-card>
        </div>
        <!-- <div class="u-page-con">
          <el-pagination
            @size-change="handleSizeChange"
            @current-change="handleCurrentChange"
            :current-page="currentPage"
            :page-sizes="[5, 10, 15, 20]"
            :page-size="pageSize"
            layout="total, sizes, prev, pager, next, jumper"
            :total="myArticle.length"
          ></el-pagination>
        </div> -->
      </div>
    </div>
  </div>
</template>

<script>
// import axios from "axios";
export default {
  name: "AiticleCard",
  props: {
    myArticle: Array
  },
  data() {
    return {
      articleSimple: [],
      //当前页
      currentPage: 1,
      // 总条数，根据接口获取数据长度(注意：这里不能为空)
      totalCount: 1,
      // 默认每页显示的条数（可修改）
      pageSize: 5,

      articlePic: [
        require("../../assets/images/aritcle-pic1.jpg"),
        require("../../assets/images/aritcle-pic2.jpg"),
        require("../../assets/images/aritcle-pic3.jpg")
      ]
    };
  },
  methods: {
    getDetail(id) {
      console.log(id);
      this.$router.push({
        name: "ArticleDetail",
        params: {
          blogId: id
        }
      });
    },

    handleSizeChange(pageSize) {
      console.log(`每页 ${pageSize} 条`);
    },
    handleCurrentChange(page) {
      console.log(`当前页: ${page}`);
    },

    randomNum(minNum, maxNum) {
      switch (arguments.length) {
        case 1:
          return parseInt(Math.random() * minNum + 1, 10);
          break;
        case 2:
          return parseInt(Math.random() * (maxNum - minNum + 1) + minNum, 10);
          break;
        default:
          return 0;
          break;
      }
    }
  }
};
</script>

<style lang="scss" scoped>
// pc端样式
.pc-show {
  display: block;
  .aiticle-card {
    .content {
      margin: 0 20px;
      text-align: center;
      .box-card {
        display: inline-block;
        margin-top: 50px;
        width: 1000px;
        height: 345px;
        cursor: pointer;
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
            min-height: 135px;
          }
          .tags-con {
            margin-top: 50px;
          }
        }
      }
    }
    .u-page-con {
      text-align: center;
      padding: 200px 0 0;
      width: 60%;
      margin: 0 auto;
    }
  }
}
// 移动端样式
.phone-show {
  display: none;
  .article-titie {
    font-size: 20px;
    font-weight: 700;
  }
  .article-author {
    padding-top: 10px;
    color:#38ba72;
    font-size: 16px;
  }
  p {
    font-size: 16px;
  }
}

// 移动端样式
@media only screen and( max-width:960px) {
  // 当屏幕宽度小于960时 认为是移动端
  .pc-show {
    display: none;
  }
  .phone-show {
    display: block;
  }

}
</style>
