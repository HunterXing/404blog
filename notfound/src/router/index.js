import Vue from 'vue'
import Router from 'vue-router'
import Home from '@/views/blog/home/Home.vue'
import Index from '@/views/blog/index/Index.vue'
import Article from '@/views/blog/article/Article.vue'
import Recommend from '@/views/blog/recommend/Recommend.vue'

Vue.use(Router)

export default new Router({
  mode: 'history',
  routes: [
    {
      path: '/',
      name: 'Index',
      component: Index,
      redirect: { name: 'Home' },
      meta: {
        title: '博客'
      },
      children: [{
        path: 'home',
        name: 'Home',
        component: Home,
        meta: {
          title: '首页'
        }
      }, {
        path: 'article',
        name: 'Article',
        component: Article,
        meta: {
          title: '我的文章'
        }
      }, {
        path: 'recommend',
        name: 'Recommend',
        component: Recommend,
        meta: {
          title: '推荐内容'
        }
      }]
    }
  ]
})
