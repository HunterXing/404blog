<template>
  <div class="write">
     <my-header></my-header>
     <mavon-editor class="editor" style="height: 100%"></mavon-editor>
  </div>
</template>

<script>
import { mavonEditor } from 'mavon-editor'
import 'mavon-editor/dist/css/index.css'

import MyHeader from './components/MyHeader'
export default {
  name: 'Write',
  components: {
    mavonEditor,
    MyHeader
    // or 'mavon-editor': mavonEditor
  }
}
</script>

<style lang="stylus" scoped>
  .write
    height: 700px
    .editor
      margin-top 50px
</style>
