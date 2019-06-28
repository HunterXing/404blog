// this.$store.state.count
import Vue from 'vue'
import Vuex from 'vuex'

Vue.use(Vuex)

export default new Vuex.Store({
  // 共享数据较多时，可以把state actions mutations 分开，模块化
  state: {
    // 测试的数字
    count: 0,
    // 默认的用户状态
    hasLogin: localStorage.hasLogin || 0
  },
  // 响应动作
  actions: {
    addNumber (ctx, number) {
      // ctx为上下文， number为dispath过来的参数
      console.log(number)
      // 将这个函数和参数发给mutations
      ctx.commit('addNumber', number)
    },
    changLoginState (ctx, hasLogin) {
      // ctx为上下文， number为dispath过来的参数
      console.log(hasLogin)
      // 将这个函数和参数发给mutations
      ctx.commit('changLoginState', hasLogin)
    }
  },
  // 变化
  mutations: {
    // 接受actions里面commit过来的函数，state, number参数
    addNumber (state, number) {
      // 变化
      state.count += number
    },
    // 接受actions里面commit过来的函数，state, number参数
    changLoginState (state, hasLogin) {
      // 变化
      state.hasLogin = hasLogin
      localStorage.hasLogin = hasLogin
    }
  }
})
