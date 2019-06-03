<template>
  <div class="home">
    <div
      class="content"
      :style="{backgroundImage: 'url(' + ('https://raw.githubusercontent.com/HunterXing/resourse/master/images/bg-summer.png') + ')'}"
    >
    </div>
  </div>
</template>

<script>

export default {
  name: 'Home',
  components: {
  },
  data () {
    return {
      carouselList: [{
        id: '1',
        name: '111',
        url: 'https://raw.githubusercontent.com/HunterXing/resourse/master/images/wallpaper-701403.jpg'
      }, {
        id: '2',
        name: '222',
        url: 'https://raw.githubusercontent.com/HunterXing/resourse/master/images/wallpaper-696758.jpg'
      }, {
        id: '3',
        name: '333',
        url: 'https://raw.githubusercontent.com/HunterXing/resourse/master/images/wallpaper-696758.jpg'
      }, {
        id: '4',
        name: '444',
        url: 'https://raw.githubusercontent.com/HunterXing/resourse/master/images/wallpaper-696758.jpg'
      }]
    }
  }
}
</script>

<style lang="scss" scoped>
 .content {
   height: 1080px;
 }
</style>
