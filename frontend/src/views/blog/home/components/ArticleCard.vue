<template>
  <div class="aiticle-card">
    <div class="content">
      <el-card class="box-card"  shadow="hover">
        <!-- 左边 -->
        <div class="left-con">
          <div class="pic"
            :style="{backgroundImage: 'url(' + (articlePic[0]) + ')'}"
          ></div>
          <p>
            <span class="p-create-time">创建时间：</span> <span>2019-5-21</span>
          </p>
          <span class="p-read-number">有1290人阅读过该文章</span>
        </div>
        <!-- 右边 -->
        <div class="right-con">
          <div class="article-titie">
            <span>No1.</span>
            制作一个简单的菜单动画效果
          </div>
          <div class="article-author">
            <i class="el-icon-s-custom"></i> xing |
            <i class="el-icon-notebook-2"></i> web前端工程师
          </div>
          <div class="article-content">
            {{articleBrief[0]}}
          </div>
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
export default {
  name: 'AiticleCard',
  data () {
    return {
      // 文章图片
      articlePic: [
        'http://gss0.baidu.com/9rkZbzqaKgQUohGko9WTAnF6hhy/mms-res/fed/ife/ife_tutor/课程配图.3fb31f3e5af7e8d7.jpg'
      ],
      // 文章简述文字
      articleBrief: [
        '关于此课程 此课程按照简单到难的顺序一共有八个任务，由浅入深的带大家了解 Web 动效落地方法 。完成这八道题，你会掌握如下技能： 熟练掌握 CSS transition 、transform 、animation 的用法 ; 怎么从一份动效标注 去 100% 还原 CSS 动画 ; 学会使用常用的 前端动画开源库 。 课程适用人群 你需要具备一定 HTML、CSS 开发基础； 你对 动效设计概念 有一定的了解，既知道怎么做，也知道为什么要这么做； 你需要具备熟练使用 git|github 的能力。 作者有话说 在后续的一段时间，我会'
      ]
    }
  }
}
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
