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
      redirect: { name: 'Recommend' },
      meta: {
        title: '博客',
        isLogin: false
      },
      children: [{
        path: 'home',
        name: 'Home',
        component: () => import('@/views/blog/home/Home.vue'),
        meta: {
          title: '首页',
          isLogin: false
        }
      }, {
        path: 'article',
        name: 'Article',
        component: () => import('@/views/blog/article/Article.vue'),
        meta: {
          title: '我的文章',
          isLogin: true
        }
      }, {
        path: 'recommend',
        name: 'Recommend',
        component: () => import('@/views/blog/recommend/Recommend.vue'),
        meta: {
          title: '推荐内容',
          isLogin: false
        }
      }]
    },
    {
      path: '/write',
      name: 'Write',
      component: () => import('@/views/blog/write/Write.vue'),
      meta: {
        title: '写文章',
        isLogin: true
      }
    },
    {
      path: '/article/detail/:blogId',
      name: 'ArticleDetail',
      component: () => import('@/views/blog/article/ArticleDetail.vue'),
      meta: {
        title: '文章详情',
        isLogin: false
      }
    }
    // {
    //   path: '/login',
    //   name: 'login',
    //   component: () => import('@/views/blog/login/Login.vue'),
    //   meta: {
    //     title: '登录',
    //     isLogin: false
    //   }
    // }
  ],
  // 路由激活状态 绑定一个class样式
  linkActiveClass: 'linkActive'
})
