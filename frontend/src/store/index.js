// this.$store.state.count
import Vue from 'vue'
import Vuex from 'vuex'
import axios from 'axios'
Vue.use(Vuex)

export default new Vuex.Store({
  // 共享数据较多时，可以把state actions mutations 分开，模块化
  state: {
    // 默认的用户状态
    auth: {
      isLogin: false
    }
  },
  // 响应动作
  actions: {
    loginCheck (ctx) {
      let auth = {}
      // 后台请求 检查用户是否登录
      axios.get('/api/user/loginCheck')
        .then(res => {
          if (res.data.errno === 0) {
            auth = res.data.data
            console.log(auth)
            ctx.commit('loginCheck', auth)
          } else {
            auth.isLogin = false
            ctx.commit('loginCheck', auth)
          }
        })
    }
  },
  // 变化
  mutations: {
    loginCheck (state, auth) {
      state.auth = auth
      console.log(state.auth)
      localStorage.isLogin = state.auth.isLogin
      // debugger
    }
  }
})
