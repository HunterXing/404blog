<template>
  <div class="write">
    <my-header></my-header>
    <div class="write-con">
      <el-input placeholder="请输入文章标题" v-model="input" class="input-group input-with-select">
        <el-select v-model="select" slot="prepend" placeholder="请选择">
          <el-option label="原创" value="1"></el-option>
          <el-option label="转载" value="2"></el-option>
        </el-select>
      </el-input>
      <mavon-editor class="editor" style="height: 100%"></mavon-editor>
    </div>
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
  },
  data () {
    return {
      input: '',
      select: ''
    }
  }
}
</script>

<style lang="stylus" scoped>
.write {
  min-height: 600px;

  .write-con {
    padding: 20px;
    height: 600px;
    .editor {
      margin-top: 50px;
    }
    .input-group {
      border: #ccc 2px solid;
      border-radius: 5px;
    }
    >>> .el-input--suffix {
      width:100px;
    }
  }
}
</style>
