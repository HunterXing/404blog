<template>
  <div class="home">
    <div class="content">
       <el-card class="box-card">
        <div slot="header" class="clearfix">
          <span class="article-title">CSS实现两个球相交的粘粘效果</span>
          <el-button style="float: right; padding: 3px 0" type="text"><i class="el-icon-circle-close"></i></el-button>
        </div>
        <div class="text item">
          这是一个纯粹利用CSS所做出来的效果，这个效果说穿了就是一个图像处理的原理，做法跟Photoshop里头的几乎一模一样，只是一个用图层和色版来制作，一个则是用CSS（把div当成图层思考就好了）。
          这是一个纯粹利用CSS所做出来的效果，这个效果说穿了就是一个图像处理的原理，做法跟Photoshop里头的几乎一模一样，只是一个用图层和色版来制作，一个则是用CSS（把div当成图层思考就好了）。
          这是一个纯粹利用CSS所做出来的效果，这个效果说穿了就是一个图像处理的原理，
          .做法跟Photoshop里头的几乎一模一样，只是一个用图层和色版来制作，一个则是用CSS（把div当成图层思考就好了）。
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
  data() {
    return {
      tags: [
        { name: '标签一', type: '' },
        { name: '标签二', type: 'success' },
        { name: '标签三', type: 'info' },
        { name: '标签四', type: 'warning' },
        { name: '标签五', type: 'danger' }
      ]
    };
  }
}
</script>

<style lang="stylus" scoped>
  .home
    .content
      min-height 1000px
      text-align center
      .text {
        font-size: 14px;
      }
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
        width: 1400px;
        text-align left
        display inline-block
        .tag {
          margin-right 6px
        }
        .article-title {
          font-weight: 700
        }
      }
</style>
