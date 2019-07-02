<template>
  <div>
    <!-- 1.头部 -->
    <div class="login-header">
      <router-link tag="div" to="/my"><span class="iconfont">&#xe65a;</span></router-link>
      <div class="login-title">用户登录</div>
      <router-link tag="div" class="login-goRegister" to="/register">注册</router-link>

    </div>

    <!-- 2.输入框 -->
    <div class="input">
      <!-- 2.1用户名 -->
      <div class="account-div">
          <input class="input-account"
          placeholder="请输入您的手机号"
          v-model="phone"
        />
      </div>
      <!-- 2.2密码 -->
      <div class="password-div">
          <input
            class="input-password"
            :type="type"
            placeholder="登录密码"
            v-model="password"
         />
         <span class="iconfont showPassword" @click="switchInputType" v-html="eyeType"></span>
      </div>
    </div>

    <!-- 3.登录 -->
    <div class="submit-div">
      <input class="submit" type="button" value="登录"  @click="doLogin">
    </div>

    <!-- 4.手机号快捷登陆 和 忘记密码的 跳转 -->
    <div class="bottomMessage-div">
      <span class="loginWithPhone">手机号快捷登录</span>
      <span class="fogotPassword">忘记密码</span>
    </div>

    <!-- 5.底部第三方登录 组件 -->
    <!-- <bottom></bottom> -->
  </div>
</template>

<script>
// import Bottom from '../common-components/Bottom'
import axios from 'axios'
// import { Toast, Indicator } from 'mint-ui'
export default {
  name: 'Login',
  // components: {
  //   Bottom
  // },
  data () {
    return {
      type: 'password', // input输入框的类型
      eyeType: '&#xe612;', // 密码输入框后面的眼睛样式  睁眼或者闭眼
      phone: '',
      password: ''
    }
  },
  methods: {
    switchInputType () {
      // 切换密码输入的可见性
      this.type = this.type === 'password' ? 'text' : 'password'
      // 切换眼睛的样式
      this.eyeType = this.eyeType === '&#xe618;' ? '&#xe612;' : '&#xe618;'
    },
    // 点击登录 进行验证
    doLogin () {
      // axios.get('/api/detail.json?id=' + this.$route.params.id) // 获取id值 并且发送ajax请求
      // 用户名和密码不可为空
      if (this.phone === '' || this.password === '') {
        Toast({
          message: '用户名和密码不可为空',
          duration: 2000
        })
      // 手机号码格式验证
      } else if (!(/^1[34578]\d{9}$/.test(this.phone))) {
        Toast({
          message: '手机号码格式不正确',
          duration: 2000
        })
        this.phone = ''
      } else {
        axios.get('/interface/index.php/Home/Login/index', {
          params: {
            phone: this.phone,
            password: this.password
          }
        }).then(this.handleGetDataSucc) // 成功返回信息 调用函数
          .catch(this.serverError) // 服务器错误 调用对应函数
      }
    },
    // 成功得到后台api返回的数据
    handleGetDataSucc (res) {
      let data = res.data
      let status = res.status
      let id = data.id
      console.log(id)
      // 成功连接服务器 状态码 200
      if (status === 200) {
        // 获取到数据即表示登录成功
        if (data) {
          // Indicator.open({
          //   text: '正在登录...',
          //   spinnerType: 'fading-circle'
          // })
          setTimeout(this.successLogin, 1000) // 延迟一秒种执行
          // this.$store.dispatch('saveUserInfo', id)
          this.$store.commit('saveUserInfo', id)
        } else {
        // 登录失败
          Toast({
            message: '登录失败',
            duration: 2000
          })
          setTimeout(this.errorLogin, 2000)
        }
      }
    },
    // 成功登录 进入首页
    successLogin () {
      Indicator.close()
      this.$router.push({path: '/'})
    },
    // 登陆失败 清空输入框 返回登陆界面
    errorLogin () {
      this.phone = ''
      this.password = ''
      this.$router.push({path: '/login'})
    },
    // ajax请求失败 服务器错误
    serverError () {
      Toast({
        message: '服务器被吃了⊙﹏⊙∥',
        duration: 2000
      })
    }
  }
}
</script>

<style lang="stylus" scoped>
  .login-header
    background #f5f5f5
    height 0.9rem
    line-height 0.9rem
    font-family 'Microsoft Yahei'
    display flex
    .iconfont
      flex 1
      font-size .4rem
      padding-left .3rem
    .login-title
      flex 8
      text-align center
      font-size: 0.32rem
      line-height: 0.83rem
    .login-goRegister
      flex 1
      text-align right
      font-size .32rem
      padding-right .3rem
  .input
    margin-top 1.2rem
    margin-bottom .68rem

    .account-div,.password-div
      margin .32rem
      background #f2f2f2
      .input-account,.input-password
        height 0.9rem
        background #f2f2f2
        padding-left .2rem
    .password-div
      display flex
      .input-password
        flex 9
      .showPassword
        flex 1
        text-align center
        line-height 0.9rem
  .submit-div
    margin-top 1rem
    display flex
    margin .32rem
    .submit
      flex 1
      background #ff9800
      height 0.9rem
      color #ffffff
      font-size 0.32rem
      font-family Arial

  .bottomMessage-div
    display flex
    margin .32rem
    .loginWithPhone
      flex 1
      height 0.46rem
      line-height 0.4rem
      font-size 0.28rem
      font-family PingFangSC-regular
    .fogotPassword
      flex 2
      text-align right
      height 0.46rem
      line-height 0.4rem
      font-size 0.28rem
      font-family PingFangSC-regular
</style>
