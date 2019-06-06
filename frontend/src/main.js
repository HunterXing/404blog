// The Vue build version to load with the `import` command
// (runtime-only or standalone) has been set in webpack.base.conf with an alias.
import Vue from 'vue'
// import App from './App'
import Index from './views/blog/index/Index'
import router from './router'
import ElementUI from 'element-ui'
import 'element-ui/lib/theme-chalk/index.css'
import 'style/reset.css'
import 'style/iconfont.css'
import 'style/main.scss'
import VueLazyload from 'vue-lazyload'

// 使得ie兼容promise
import promise from 'es6-promise'
promise.polyfill()

Vue.config.productionTip = false
Vue.use(ElementUI)
Vue.use(VueLazyload)
/* eslint-disable no-new */
new Vue({
  el: '#app',
  router,
  components: { Index },
  template: '<router-view/>'
})

// 路由跳转时改变title
router.beforeEach((to, from, next) => {
  /* 路由发生变化修改页面title */
  if (to.meta.title) {
    document.title = to.meta.title
  }
  next()
})
