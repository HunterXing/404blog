<template>
  <div id="m-header">
    <div class="tab" v-for="(tab, index) in tabs" :key="index" @click="selectTab(tab)">
          <i class="iconfont" :class="tab.icon"></i>
          <span>{{ tab.name }}</span>
    </div>
  </div>
</template>

<script>
export default {
  name: 'MyHeader',
  data () {
    return {
      isPc: true,
      tabs: [
        {
          name: '首页',
          icon: 'icon-home',
          to: 'home'
        },
        {
          name: '分类/标签',
          icon: 'icon-tag',
          to: 'categories'
        },
        {
          name: '归档',
          icon: 'icon-archives',
          to: 'archives'
        },
        {
          name: '关于',
          icon: 'icon-about',
          to: 'about'
        },
        {
          name: '友链',
          icon: 'icon-friends-link',
          to: 'friends'
        },
        {
          name: '更多',
          icon: 'icon-more',
          to: 'morefunc'
        },
        {
          name: '搜索',
          icon: 'icon-search',
          to: 'search'
        }
      ],
      lineStyle: {
        normalLineData: [
          {
            width: '100%',
            top: '0px',
            transform: 'rotateZ(0deg)',
            opacity: '1'
          },
          {
            width: '100%',
            top: '0px',
            transform: 'rotateZ(0deg)',
            opacity: '1'
          },
          {
            width: '100%',
            top: '0px',
            transform: 'rotateZ(0deg)',
            opacity: '1'
          }
        ],
        closeLineData: [
          {
            width: '100%',
            top: '6px',
            transform: 'rotateZ(-45deg)',
            opacity: '1'
          },
          {
            width: '100%',
            top: '0px',
            transform: 'rotateZ(0deg)',
            opacity: '0'
          },
          {
            width: '100%',
            top: '-6px',
            transform: 'rotateZ(45deg)',
            opacity: '1'
          }
        ]
      },
      toggleLineData: [],
      showMobileTabs: false
    }
  },
  watch: {
    screen (value) {
      this.isPc = true
      if (value.width <= 768) {
        this.isPc = false
      }
    }
  },
  created () {
    this.toggleLineData = this.lineStyle.normalLineData
  },
  methods: {
    toHomeFromLogo () {
      window.location.href = `${window.location.origin}`
    },
    toggle () {
      this.showMobileTabs = !this.showMobileTabs
      this.toggleLineData = this.showMobileTabs ? this.lineStyle.closeLineData : this.lineStyle.normalLineData
    },
    selectTab (tab) {
      if (tab.to === 'morefunc') {
        this.$toast('更多功能待开发...')
        return
      }
      this.toggle()
      this.$router.push({name: tab.to})
    }
  }
}
</script>

<style lang="stylus" scoped>

</style>
