// The Vue build version to load with the `import` command
// (runtime-only or standalone) has been set in webpack.base.conf with an alias.
import Vue from 'vue'
// import App from './App'
import Index from './views/blog/index/Index'
import router from './router'
import ElementUI from 'element-ui'
import store from './store'
import ECharts from 'vue-echarts/components/ECharts'
import vueEventCalendar from 'vue-event-calendar'

import 'vue-event-calendar/dist/style.css'
import 'element-ui/lib/theme-chalk/index.css'
import 'style/reset.css'
import 'style/iconfont.css'
import 'style/main.scss'

Vue.config.productionTip = false

Vue.use(vueEventCalendar, {locale: 'zh'}) //可以设置语言，支持中文和英文
Vue.component('chart', ECharts)
Vue.use(ElementUI)
/* eslint-disable no-new */
new Vue({
  el: '#app',
  store,
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
