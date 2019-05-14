import Vue from 'vue'
import Router from 'vue-router'

Vue.use(Router)

export default new Router({
  mode: 'history',
  routes: [
    {
      path: '/',
      name: 'Index',
      component: () => import('@/views/blog/index/Index.vue'),
      redirect: { name: 'Home' },
      meta: {
        title: '博客'
      },
      children: [{
        path: 'home',
        name: 'Home',
        component: () => import('@/views/blog/home/Home.vue'),
        meta: {
          title: '首页'
        }
      }, {
        path: 'article',
        name: 'Article',
        component: () => import('@/views/blog/article/Article.vue'),
        meta: {
          title: '我的文章'
        }
      }, {
        path: 'recommend',
        name: 'Recommend',
        component: () => import('@/views/blog/recommend/Recommend.vue'),
        meta: {
          title: '推荐内容'
        }
      }]
    }
  ],
  // 路由激活状态 绑定一个class样式
  linkActiveClass: 'linkActive'
})
