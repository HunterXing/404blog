<template>
  <div class="write">
    <my-header @doSubmit="doSubmit" @saveAritcle="saveAritcle"></my-header>
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
      <mavon-editor class="editor" style="height: 100%" ref="editor" v-model="form.articleText"></mavon-editor>
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
        articleText: "",
        link: ""
      },
      dynamicTags: ["标签一", "标签二", "标签三"],
      inputVisible: false,
      inputValue: ""
    };
  },
  mounted() {
    if (this.$route.params.blogId) {
       this.getEditArticle();
    }

  },
  methods: {
    // 得到需要编辑的文章
    getEditArticle() {
      this.axios
        .post(
          "/api/blog/getEditArticle",
          qs.stringify({
            blogId: this.$route.params.blogId
          })
        )
        .then(res => {
          console.log(res);
          let data = res.data.data;
          this.form.articleTitle = data.title;
          this.form.articleType = data.type+"";
          this.form.articleText = data.markdown;
          this.form.link = data.link;
        })
        .catch(error => {
          console.log(error);
        });
    },
    // 发布文章按钮
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
        let reg = /^([hH][tT]{2}[pP]:\/\/|[hH][tT]{2}[pP][sS]:\/\/)/;
        if (!reg.test(link)) {
          this.$message({
            type: "error",
            message: "请输入正确的网址"
          });
          return;
        }
      }

      // 如果路由中有参数 说明是编辑
      if (this.$route.params.blogId) {
        this.editArticle(html, markdown);
      } else {
        // 没有参数就是添加文章
        this.addArticle(html, markdown);
      }
    },
    // 添加文章
    addArticle(html, markdown) {
      // addArticle
      console.log(this.$store.state.auth.id)
      debugger
      this.axios
        .post(
          "/api/blog/addArticle",
          qs.stringify({
            author_id: this.$store.state.auth.id,
            title: this.form.articleTitle,
            content: html,
            type: this.form.articleType,
            link: this.form.link,
            markdown: markdown
          })
        )
        .then(res => {
          // console.log(res);
          let code = res.data.errno;
          let message = res.data.message;
          if (code === 0) {
            let blogId = res.data.data.id;
            this.$message({
              type: "success",
              message: message
            });
            setTimeout(() => {
              this.$router.push({
                name: "ArticleDetail",
                params: {
                  blogId: blogId
                }
              });
            }, 1500);
          }
        })
        .catch(error => {
          console.log(error);
        });
    },
    // 编辑文章
    editArticle(html, markdown) {
      this.axios
        .post(
          "/api/blog/editArticle",
          qs.stringify({
            // userId: this.$store.state.auth.id,
            blogId: this.$route.params.blogId,
            title: this.form.articleTitle,
            detail: html,
            type: this.form.articleType,
            link: this.form.link,
            markdown: markdown
          })
        )
        .then(res => {
          console.log(res);
          let code = res.data.errno;
          let message = res.data.message;
          if (code ===  0) {
            let blogId = this.$route.params.blogId;
            this.$message({
              type: "success",
              message: message
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
              message: message
            });
          }
        })
        .catch(error => {
          console.log(error);
        });
    },
    // 暂时保存文章到草稿箱
    saveAritcle() {
      this.$message({
        type: "success",
        message: "草稿箱功能暂时未实现，所以此功能暂缓"
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
