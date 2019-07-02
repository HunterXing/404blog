<template>
  <div class="m-footer-bar">
    <div class="bar-con">
      <!-- 推荐 -->
      <router-link tag="div" :to="{name: 'Recommend'}" class="recomment">
        <i class="iconfont hot">&#xe633;</i>
        <span class="link">推荐</span>
      </router-link>
      <!-- 我的文章 -->
      <router-link tag="div" :to="{name: 'Article'}" class="my-article">
        <i class="el-icon-tickets"></i>
        <span class="link">我的</span>
      </router-link>
    </div>
  </div>
</template>

<script>
export default {
  name: "FooterBar",
  data() {
    return {
      runningTime: 0
    };
  },
  methods: {}
};
</script>
<style lang="scss" scoped>
.m-footer-bar {
  background: #fff;
  position: fixed;
  bottom: 0;
  width: 100%;
  height: 50px;
  .bar-con {
    display: flex;
    .recomment {
      text-align: center;
      flex: 1;
      height: 50px;
      line-height: 50px;
      display: inline-block;
    }
    .my-article {
      text-align: center;
      flex: 1;
      height: 50px;
      line-height: 50px;
      display: inline-block;
    }
  }
}
.linkActive {
  // border-bottom: 3px solid #009a61
  color: #009a61;
  font-weight: 700;
  background: #f5f5f5;
}
</style>

