<template>
  <div class="write">
    <my-header @doSubmit="doSubmit"></my-header>
    <div class="write-con">
      <el-input
        placeholder="请输入文章标题"
        v-model="form.articleTitle"
        class="input-group input-with-select"
      >
        <el-select v-model="form.articleType" slot="prepend" placeholder="请选择">
          <el-option label="原创" value="0"></el-option>
          <el-option label="转载" value="1"></el-option>
        </el-select>
      </el-input>
      <div class="reprint-link-con" v-show="form.articleType === '1'">
        <el-input placeholder="请输入原文链接" v-model="form.link"></el-input>
      </div>

      <div class="tags-con">
        <el-tag
          :key="tag"
          v-for="tag in dynamicTags"
          closable
          :disable-transitions="false"
          @close="handleClose(tag)"
        >{{tag}}</el-tag>
        <el-input
          class="input-new-tag"
          v-if="inputVisible"
          v-model="inputValue"
          ref="saveTagInput"
          size="small"
          @keyup.enter.native="handleInputConfirm"
          @blur="handleInputConfirm"
        ></el-input>
        <el-button v-else class="button-new-tag" size="small" @click="showInput">+ New Tag</el-button>
      </div>
      <!-- <mavon-editor
        class="editor"
        style="height: 100%"
        ref="editor"
        @imgAdd="$imgAdd"
      ></mavon-editor>-->
      <mavon-editor class="editor" style="height: 100%" ref="editor"></mavon-editor>
    </div>
  </div>
</template>

<script>
import { mavonEditor } from "mavon-editor";
import "mavon-editor/dist/css/index.css";
import MyHeader from "./components/MyHeader";
import qs from "qs";
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
        articleValue: "",
        link: ""
      },
      dynamicTags: ["标签一", "标签二", "标签三"],
      inputVisible: false,
      inputValue: ""
    };
  },
  methods: {
    doSubmit() {
      // 获取 markdown 暂时用不到
      let markdown = this.$refs.editor.d_value;

      // 获取编译后的 html
      let html = this.$refs.editor.d_render;
      this.form.articleValue = html;
      // debugger;
      // console.log("submit");
      // console.log(markdown);
      // console.log(html);

      if (this.form.articleType === "1") {
        let link = this.form.link;
        let reg = /^([hH][tT]{2}[pP]:\/\/|[hH][tT]{2}[pP][sS]:\/\/)(([A-Za-z0-9-~]+)\.)+([A-Za-z0-9-~\/])+$/;
        if (!reg.test(link)) {
          this.$message({
            type: "error",
            message: "请输入正确的网址"
          });
          return;
        }
      }

      // addArticle
      this.axios
        .post(
          "/phpApi/Home/Article/addArticle",
          qs.stringify({
            userId: this.$store.state.userId,
            title: this.form.articleTitle,
            detail: html,
            type: this.form.articleType,
            link: this.form.link
          })
        )
        .then(res => {
          console.log(res);
          let code = res.data.code;
          let blogId = res.data.blogId;
          if (code > 0) {
            this.$message({
              type: "success",
              message: "发布文章成功"
            });
            setTimeout(() => {
              this.$router.push({
                name: "ArticleDetail",
                params: {
                  blogId: blogId
                }
              });
            }, 1500);
          } else {
            this.$message({
              type: "error",
              message: "文章发布失败"
            });
          }
        })
        .catch(error => {
          console.log(error);
        });
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
    },

    // 标签页部分的事件
    handleClose(tag) {
      this.dynamicTags.splice(this.dynamicTags.indexOf(tag), 1);
    },

    showInput() {
      this.inputVisible = true;
      this.$nextTick(_ => {
        this.$refs.saveTagInput.$refs.input.focus();
      });
    },

    handleInputConfirm() {
      let inputValue = this.inputValue;
      if (inputValue) {
        this.dynamicTags.push(inputValue);
      }
      this.inputVisible = false;
      this.inputValue = "";
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
    width: 95%;
    margin: 0 auto;

    .editor {
      margin-top: 50px;
    }

    .reprint-link-con {
      .input-group, .el-input {
        border: #ccc 2px solid;
        border-radius: 5px;
      }
    }

    >>> .el-input--suffix {
      width: 100px;
    }

    .reprint-link-con {
      margin-top: 20px;
    }
  }

  .tags-con {
    margin-top: 20px;
  }

  .el-tag + .el-tag {
    margin-left: 10px;
  }

  .button-new-tag {
    margin-left: 10px;
    height: 32px;
    line-height: 30px;
    padding-top: 0;
    padding-bottom: 0;
  }

  .input-new-tag {
    width: 90px;
    margin-left: 10px;
    vertical-align: bottom;
  }
}
</style>
