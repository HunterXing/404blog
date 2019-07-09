// this.$store.state.count
import Vue from 'vue'
import Vuex from 'vuex'

Vue.use(Vuex)

export default new Vuex.Store({
  // 共享数据较多时，可以把state actions mutations 分开，模块化
  state: {
    // 默认的用户状态
    hasLogin: 0,
    username: ''
  },
  // 响应动作
  actions: {
    changLoginState (ctx, params) {
      // ctx为上下文， 后面为dispath过来的参数
      console.log(params.hasLogin)
      // 将这个函数和参数发给mutations
      ctx.commit('changLoginState', params)
    }
  },
  // 变化
  mutations: {
    // 接受actions里面commit过来的函数，state, number参数
    changLoginState (state, params) {
      // 变化
      state.hasLogin = params.hasLogin
      state.username = params.username
    }
  }
})