import Vue from 'vue'
import Vuex from 'vuex'

Vue.use(Vuex)

export default new Vuex.Store({
  state: {
    count: 0
  },
  actions: {
    addNumber (ctx, number) {
      // ctx为上下文， number为dispath过来的参数
      console.log(number)
      // 将这个函数和参数发给mutations
      ctx.commit('addNumber', number)
    }
  },
  mutations: {
    // 接受actions里面commit过来的函数，state, number参数
    addNumber (state, number) {
      state.count += number
    }
  }
})
