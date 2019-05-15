<template>
  <div class="home">
    <div class="content">
       <el-card class="box-card">
        <div slot="header" class="clearfix">
          <span class="article-title">CSS实现两个球相交的粘粘效果</span>
          <el-button style="float: right; padding: 3px 0" type="text"><i class="el-icon-circle-close"></i></el-button>
        </div>
        <div class="article-simple-content">
          <div class="text item">
          这是一个纯粹利用CSS所做出来的效果，这个效果说穿了就是一个图像处理的原理，做法跟Photoshop里头的几乎一模一样，只是一个用图层和色版来制作，一个则是用CSS（把div当成图层思考就好了）。
          </div>
          <!-- 文章图片简略图 -->
          <div class="poster-box"
              :style="{backgroundImage: 'url(' + backPic + ')'}"
              >
          </div>
        </div>

        <el-tag
          class="tag"
          v-for="tag in tags"
          :key="tag.name"
          closable
          :type="tag.type">
          {{tag.name}}
        </el-tag>
      </el-card>
    </div>

  </div>
</template>

<script>
export default {
  name: 'Home',
  data () {
    return {
      tags: [
        { name: '标签一', type: '' },
        { name: '标签二', type: 'success' },
        { name: '标签三', type: 'info' },
        { name: '标签四', type: 'warning' },
        { name: '标签五', type: 'danger' }
      ],
      backPic: 'http://performancesolutionsbymilliken.com/wp-content/uploads/2017/09/training-blog-header.jpg'
    }
  }
}
</script>

<style lang="stylus" scoped>
  .home
    .content
      min-height 1000px
      text-align center
      // display flex

      .item {
        margin-bottom: 18px;
      }
      .clearfix:before,
      .clearfix:after {
        display: table;
        content: "";
      }
      .clearfix:after {
        clear: both
      }
      .box-card {
        margin-top 20px
        width: 1000px;
        text-align left
        display inline-block
        .article-simple-content {
          display flex
          .text {
            width 400px
            height 120px
            display: -webkit-box;
            -webkit-box-orient: vertical;
            -webkit-line-clamp: 3;
            overflow: hidden
            font-size: 14px;
            line-height: 30px;
            padding-right 200px
          }
          .poster-box {
            margin-right 200px
            // flex 4
            width 150px
            height 150px
            background-size 100% 100%
          }
        }
        .tag {
          margin-right 6px
        }
        .article-title {
          font-weight: 700
        }
      }
</style>
