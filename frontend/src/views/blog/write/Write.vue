<template>
  <div class="write">
    <my-header @doSubmit="doSubmit"></my-header>
    <div class="write-con">
      <el-input placeholder="请输入文章标题" v-model="form.articleTitle" class="input-group input-with-select">
        <el-select v-model="form.articleType" slot="prepend" placeholder="请选择">
          <el-option label="原创" value="0"></el-option>
          <el-option label="转载" value="1"></el-option>
        </el-select>
      </el-input>
      <div class="reprint-link-con"  v-show="form.articleType === '1'">
        <el-input placeholder="请输入原文链接"></el-input>
      </div>
      <!-- <mavon-editor
        class="editor"
        style="height: 100%"
        ref="editor"
        @imgAdd="$imgAdd"
      ></mavon-editor> -->
      <mavon-editor
        class="editor"
        style="height: 100%"
        ref="editor"
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
      form: {
        articleTitle: "",
        articleType: "0",
        articleValue: ""
      }
    };
  },
  methods: {
    doSubmit() {
      // 获取 markdown 暂时用不到
      let markdown = this.$refs.editor.d_value;

      // 获取编译后的 html
      let html = this.$refs.editor.d_render;
      this.form.articleValue = html;
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
      this.axios({
        url: "server url",
        method: "post",
        data: formdata,
        headers: { "Content-Type": "multipart/form-data" }
      }).then(url => {
        // 第二步.将返回的url替换到文本原位置![...](0) -> ![...](url)
        /**
         * $vm 指为mavonEditor实例，可以通过如下两种方式获取
         * 1. 通过引入对象获取: `import {mavonEditor} from ...` 等方式引入后，`$vm`为`mavonEditor`
         * 2. 通过$refs获取: html声明ref : `<mavon-editor ref=md ></mavon-editor>，`$vm`为 `this.$refs.md`
         */
        // $vm.$img2Url(pos, url);
        this.$refs.editor.$img2Url(pos, url);
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

    .input-group, .el-input {
      border: #ccc 2px solid;
      border-radius: 5px;
    }

    >>> .el-input--suffix {
      width: 100px;
    }
    .reprint-link-con {
      margin-top: 20px;
    }
  }
}
</style>
