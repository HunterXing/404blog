<template>
  <div class="write">
    <my-header @doSubmit="doSubmit"></my-header>
    <div class="write-con">
      <el-input placeholder="请输入文章标题" v-model="articleTitle" class="input-group input-with-select">
        <el-select v-model="articleType" slot="prepend" placeholder="请选择">
          <el-option label="原创" value="0"></el-option>
          <el-option label="转载" value="1"></el-option>
        </el-select>
      </el-input>
      <mavon-editor
        class="editor"
        style="height: 100%"
        ref="editor"
        v-model="articleValue"
        @imgAdd="$imgAdd"
        @imgDel="$imgDel"
      ></mavon-editor>
    </div>
  </div>
</template>

<script>
import { mavonEditor } from "mavon-editor";
import "mavon-editor/dist/css/index.css";
import MyHeader from "./components/MyHeader";
export default {
  name: "Write",
  components: {
    mavonEditor,
    MyHeader
  },
  data() {
    return {
      articleTitle: "",
      articleType: "",
      articleValue: ""
    };
  },
  methods: {
    doSubmit() {
      // 获取 markdown
      let markdown = this.$refs.editor.d_value;

      // 获取编译后的 html
      let html = this.$refs.editor.d_render;
      debugger;
      console.log("submit");
      console.log(markdown);
      console.log(html);
    },

    // 绑定@imgAdd event
    $imgAdd(pos, $file) {
      // 第一步.将图片上传到服务器.
      var formdata = new FormData();
      formdata.append("image", $file);
      axios({
        url: "server url",
        method: "post",
        data: formdata,
        headers: { "Content-Type": "multipart/form-data" }
      }).then(url => {
        // 第二步.将返回的url替换到文本原位置![...](0) -> ![...](url)
        // $vm.$img2Url 详情见本页末尾
        $vm.$img2Url(pos, url);
      });
    }
    
  }
};
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
      width: 100px;
    }
  }
}
</style>
