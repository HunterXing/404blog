<template>
  <div class="header-con">
    <!-- pc端 -->
    <div class="pc-header-show">
      <div class="m-header">
        <!-- logo标志 -->
        <router-link tag="div" :to="{name: 'Home'}" class="left-logo">
          <img src="../../assets/logo.png">
        </router-link>
        <!-- tab 集合 -->
        <!-- 首页 -->
        <router-link tag="div" :to="{name: 'Home'}" class="first">
          <span class="link">关于作者</span>
        </router-link>
        <!-- 推荐 -->
        <router-link tag="div" :to="{name: 'Recommend'}" class="recomment">
          <i class="iconfont hot">&#xe633;</i>
          <span class="link">推荐</span>
        </router-link>
        <!-- 我的文章 -->
        <router-link tag="div" :to="{name: 'Article'}" class="my-article">
          <i class="el-icon-tickets"></i>
          <span class="link">my文章</span>
        </router-link>
        <!--  标签-->
        <div class="tags"></div>
        <!-- 搜索栏 -->
        <div class="right-search">
          <input
            ref="search"
            type="text"
            class="input-search"
            placeholder="搜索文章或关键字"
            @click="inputClick"
          >
        </div>
        <!-- 个人信息区域 -->
        <div class="message-box" @click="getMyMessage()">
          <span class="iconfont message-icon">
            &#xe66e;
            <span class="number">15</span>
          </span>
        </div>

        <!-- 写文章 -->
        <div class="write" v-if="hasLogin">
          <el-button type="plain" plain @click.native="toWrite()">写文章</el-button>
        </div>
        <!-- 头像 -->
        <div class="header-box" v-if="hasLogin">
          <!-- 截取用户名首字为头像 -->
           <el-avatar style=" margin-top: 5px;background: #009a61;">{{this.$store.state.username.slice(0,1)}}</el-avatar>
        </div>
        <div class="login-register" v-if="!hasLogin">
          <el-button @click="doLoginOrRegis('0')">立即登录</el-button>
          <el-button type="success" @click="doLoginOrRegis('1')">免费注册</el-button>
        </div>
      </div>
    </div>

    <!-- 移动端 待做-->
    <div class="phone-header-show">
      <div class="m-header">
        <!-- logo标志 -->
        <router-link tag="div" :to="{name: 'Recommend'}" class="left-logo">
          <img src="../../assets/logo.png">
        </router-link>
        <!-- 头像 -->
        <!-- 头像 -->
        <div class="header-box" v-if="hasLogin">
          <!-- 截取用户名首字为头像 -->
           <el-avatar style=" margin-top: 5px;background: #009a61;">{{this.$store.state.username.slice(0,1)}}</el-avatar>
        </div>
        <div class="login-register" v-if="!hasLogin">
          <el-button type="mini" @click="doLoginOrRegis('0')">登录</el-button>
          <!-- <el-button type="success" @click="doLoginOrRegis('1')">免费注册</el-button> -->
        </div>
      </div>
    </div>
  </div>
</template>

<script>
export default {
  name: 'MyHeader',
  data () {
    return {
      headerPic:
        'https://avatar-static.segmentfault.com/421/904/4219049238-5c96fb0fef7e6_huge256',

      type: '-1'
    }
  },
  methods: {
    // 点击输入框 我想把输入框变长
    inputClick () {
      console.log(this.$refs.search.style)
      // this.$refs.search
    },
    // 去写文章
    toWrite () {
      this.$router.push({
        name: 'Write',
        params: {
            blogId: ''
        }
      })
    },

    // 登陆或者注册
    doLoginOrRegis (type) {
      this.type = type
      if (type === '0') {
        // console.log('to login')
        this.$emit('doLoginOrRegis', this.type)
      } else {
        // console.log('to register')
        // this.$emit('doLoginOrRegis', this.type)
        this.$message({
          type: 'error',
          message: '个人博客，暂不支持注册'
        })
      }
    },
    // 得到个人收件信息
    getMyMessage () {
      // todo
       this.$message({
          type: 'error',
          message: '暂不支持查看邮件'
      })
    }
  },
  computed: {
    // let hasLogin = 0
    hasLogin () {
     let  hasLogin = this.$store.state.hasLogin
      return hasLogin
    }
    // return hasLogin
  }
}
</script>

<style lang="scss" scoped>
// pc端样式
.pc-header-show {
  display: block;
  .m-header {
    height: 50px;
    line-height: 50px;
    border-top: 3px solid #009a61;
    box-shadow: 0px 2px 10px 0px rgba(0, 0, 0, 0.1), 0 1px rgba(0, 0, 0, 0.1);
    background: #fff;
    z-index: 3;
    display: flex;
    min-width: 1200px;

    .left-logo {
      flex: 6;
      line-height: 60px;
      padding-left: 50px;
      border-radius: 10px;

      img {
        width: 180px;
      }
    }

    .left-logo :hover {
      border-radius: 10px;
      border: 0.5px dashed #009a61;
      box-shadow: 0px 0px 10px 0px rgba(0, 0, 0, 0.1), 0 0px rgba(0, 0, 0, 0.1);
    }
    .first,
    .recomment,
    .my-article,
    .tags {
      flex: 2;
      text-align: center;
    }

    .recomment {
      .hot {
        color: red;
      }
    }
    .linkActive {
      // border-bottom: 3px solid #009a61
      color: #009a61;
      font-weight: 700;
    }

    .right-search {
      flex: 6;

      .input-search {
        display: inline-block;
        padding: 4px 8px;
        width: 200px;
        // border-radius 5px
      }
    }

    .message-box {
      flex: 2;
      margin: 0 10px;

      .message-icon {
        color: #888;
        font-size: 32px;
        padding: 2px 10px;

        .number {
          font-size: 10px;
          color: #fff;
          padding: 2px 4px;
          margin-left: -10px;
          background: #ffa500;
          border-radius: 10px;
        }
      }
    }

    .write {
      flex: 2;
    }

    .header-box {
      flex: 5;
      display: inline-block;
      height: 50px;
      line-height: 65px;
      text-align: left;
      padding: 0 0 0 20px;

      img {
        width: 25px;
        height: 25px;
        border-radius: 20px;
        border: 0.5px dashed #009a61;
      }
    }
    .login-register {
      flex: 5;
    }
  }
}
// 移动端样式
.phone-header-show {
  display: none;
  .m-header {
    height: 50px;
    line-height: 50px;
    border-top: 3px solid #009a61;
    box-shadow: 0px 2px 10px 0px rgba(0, 0, 0, 0.1), 0 1px rgba(0, 0, 0, 0.1);
    background: #fff;
    z-index: 3;
    display: flex;
    width: 100%;
    .left-logo {
      flex: 2;
      line-height: 60px;
      padding-left: 10px;
      border-radius: 10px;
      img {
        width: 180px;
      }
    }
    .left-logo :hover {
      border-radius: 10px;
      border: 0.5px dashed #009a61;
      box-shadow: 0px 0px 10px 0px rgba(0, 0, 0, 0.1), 0 0px rgba(0, 0, 0, 0.1);
    }
    .header-box {
      flex: 0.5;
      display: inline-block;
      height: 50px;
      line-height: 65px;
      padding: 0 0 0 20px;
    }
    .login-register {
      flex: 0.5;
    }
  }
}

// 移动端样式
@media only screen and( max-width:960px ) {
  // 当屏幕宽度小于960时 认为是移动端
  .pc-header-show {
    display: none;
  }
  .phone-header-show {
    display: block;
  }
}

// PC样式
@media only screen and( min-width:960px ) {
  // 当屏幕宽度小于960时 认为是移动端
  .pc-header-show {
    display: block;
  }
  .phone-header-show {
    display: none;
  }
}
</style>
