<template>
  <div class="home" :style="{backgroundImage: 'url(' + (backImg[0]) + ')'}">
    <my-header @doLoginOrRegis="doLoginOrRegis"></my-header>
    <div class="content">
      <!-- 嵌套路由-->
      <router-view></router-view>
    </div>
    <my-footer></my-footer>
    <go-top @goTop="goTop" :backTopShow="backTopShow" :backSeconds="backSeconds" :showPx="showPx"></go-top>

    <!-- 登录 -->
    <el-dialog
      title="登录"
      :visible.sync="dialogFormVisible"
      width="30%"
      @close="cancel('form')"
      :append-to-body="true"
      :close-on-click-modal="false"
    >
      <el-form ref="form" :model="form" label-width="106px" :rules="rules">
        <el-form-item label="账户:" prop="username">
          <el-input v-model="form.username"></el-input>
        </el-form-item>
        <el-form-item label="密码:" prop="password" type="password">
          <el-input v-model="form.password"></el-input>
        </el-form-item>
      </el-form>

      <div slot="footer" class="dialog-footer">
        <el-button @click="cancel('form')">取 消</el-button>
        <el-button type="primary" @click="doLogin('form')">确 定</el-button>
      </div>
    </el-dialog>
  </div>
</template>

<script>
import MyHeader from "common/header/MyHeader";
import MyFooter from "common/footer/MyFooter";
import GoTop from "common/goTop/GoTop";
import qs from "qs";
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
      loginOrRegister: "-1",
      dialogFormVisible: false,
      form: {
        username: "",
        password: ""
      },
      rules: {
        username: [
          { required: true, message: "请输入账户", trigger: "change" }
        ],
        password: [{ required: true, message: "请输入密码", trigger: "change" }]
      }
    };
  },
  methods: {
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
    },
    doLoginOrRegis(type) {
      // console.log(type);
      this.loginOrRegister = type;
      this.dialogFormVisible = true;
    },
    // 登录
    doLogin(form) {
      // let self = this;
      this.$refs[form].validate(valid => {
        if (valid) {
          console.log(this.form);
          this.axios
            .post(
              // "http://localhost/404blog/backend/php/index.php/Home/Login/index",
              "/phpApi/Home/Login/index",
              qs.stringify({
                username: this.form.username,
                password: this.form.password
              })
            )
            .then(res => {
              let code = res.data.code
              if (code > 0) {
                this.$message({
                  type: 'success',
                  message: '登录成功'
                })
                this.$store.dispatch('changLoginState', 1)
                this.cancel('form')
              } else {
                 this.$message({
                  type: 'error',
                  message: '登录失败，用户名或密码错误'
                })
              }
              // console.log(res.data.code);
              // debugger
            })
            .catch(error => {
              console.log(error);
            });
        }
      });
    },
    cancel(form) {
      this.dialogFormVisible = false;
      // 清楚验证提示信息和表单内容
      this.$refs[form].resetFields();
    }
  },
  mounted() {
    // 页面挂载时就启动监听
    // document.documentElement.scrollTop = 0
    window.addEventListener("scroll", this.backTopShowOperate, true);
  }
};
</script>

<style lang="stylus" scoped>
>>> .el-dialog__header {
  padding: 20px 20px 10px;
  background: #f5f5f5;
}

>>> .el-dialog__title {
  line-height: 24px;
  font-size: 24px;
  color: #303133;
}

>>> .el-form-item__label {
  font-size: 20px;
}

.home {
  background-size: contain;
  background-position: top center;
  background-repeat: no-repeat;

  .content {
    min-height: 900px;
  }
}
</style>
