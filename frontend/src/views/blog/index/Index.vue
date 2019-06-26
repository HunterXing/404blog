<template>
  <div class="home" :style="{backgroundImage: 'url(' + (backImg[0]) + ')'}">
    <my-header @doLoginOrRegis="doLoginOrRegis"></my-header>
    <div class="content">
      <!-- 嵌套路由-->
      <router-view></router-view>
    </div>
    <my-footer></my-footer>
    <go-top @goTop="goTop" :backTopShow="backTopShow" :backSeconds="backSeconds" :showPx="showPx"></go-top>
    <el-dialog title="收货地址" :visible.sync="dialogFormVisible">
      <!-- <el-form :model="form">
        <el-form-item label="活动名称" :label-width="formLabelWidth">
          <el-input v-model="form.name" autocomplete="off"></el-input>
        </el-form-item>
        <el-form-item label="活动区域" :label-width="formLabelWidth">
          <el-select v-model="form.region" placeholder="请选择活动区域">
            <el-option label="区域一" value="shanghai"></el-option>
            <el-option label="区域二" value="beijing"></el-option>
          </el-select>
        </el-form-item>
      </el-form> -->
      <div slot="footer" class="dialog-footer">
        <el-button @click="dialogFormVisible = false">取 消</el-button>
        <el-button type="primary" @click="dialogFormVisible = false">确 定</el-button>
      </div>
    </el-dialog>
  </div>
</template>

<script>
import MyHeader from "common/header/MyHeader"
import MyFooter from "common/footer/MyFooter"
import GoTop from "common/goTop/GoTop"
export default {
  name: "Index",
  components: {
    MyHeader,
    MyFooter,
    GoTop
  },
  data() {
    return {
      // 是否显示回到顶部
      backTopShow: false,
      // // 是否允许操作返回顶部
      backTopAllow: true,
      // 返回顶部所需时间
      backSeconds: 100,
      // 往下滑动多少显示返回顶部（单位：px)
      showPx: 100,
      backImg: [require("../../../assets/images/bg-summer-day.png")],
      loginOrRegister: '-1',
      dialogFormVisible: false
    }
  },
  methods: {
    // 返回顶部的显示与隐藏操作
    backTopShowOperate() {
      // TMD页面被卷起的距离
      let marginTop =
        document.documentElement.scrollTop || document.body.scrollTop;
      console.log(marginTop);
      if (this.backTopAllow) {
        if (marginTop > this.showPx) {
          this.backTopShow = true
        } else {
          this.backTopShow = false
        }
      }
    },
    // 点击返回顶部的操作
    goTop () {
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
    },
    doLoginOrRegis(type) {
      console.log(type);
      this.loginOrRegister = type
      this.dialogFormVisible = true
    }
  },
  mounted () {
    // 页面挂载时就启动监听
    // document.documentElement.scrollTop = 0
    window.addEventListener("scroll", this.backTopShowOperate, true)
  }
};
</script>

<style lang="stylus" scoped>
.home {
  background-size: contain;
  background-position: top center;
  background-repeat: no-repeat;

  .content {
    min-height: 1000px;
  }
}
</style>
