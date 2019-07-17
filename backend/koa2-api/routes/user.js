const router = require('koa-router')()

const {
  login,
  userInfo
} = require('../controller/userController')
const {
  SuccessModel,
  ErrorModel
} = require('../model/resModel')

router.prefix('/api/user')


// 登录
router.post('/login', async (ctx, next) => {
  const {
    username,
    password
  } = ctx.request.body
  // console.log(ctx.request)
  const result = await login(username, password)
  if (result.username) {
    // 设置 session
    // ctx.session  = {}
    ctx.session.username = result.username; // 登录成功，设置 session
    ctx.session.realname = result.realname
    console.log('ctx:', ctx.session)
    // ctx.session.realname = data.realname
    ctx.body = new SuccessModel('登录成功')
  } else {
    ctx.body = new ErrorModel('登录失败')
  }
  
});

// 退出
router.get('/exit', async (ctx, next) => {
  let result = delete ctx.session.username
  // console.log('exit:', result)
  if (result) {
    ctx.body = new SuccessModel('退出成功')

  } else {

    ctx.body = new SuccessModel('退出失败')

  }
});

// 登录验证
router.get('/loginCheck', async (ctx, next) => {
  if (ctx.session.username) {
    const result = await userInfo(ctx.session.username)
   if(result){
      result.isLogin = true
      ctx.body = new SuccessModel(result)
    }
  } else {
    ctx.body = new ErrorModel('未登录')
  }
  
})



// 测试session
router.get('/session-test', async (ctx, next) => {
  if (ctx.session.viewCount == null) {
    ctx.session.viewCount = 0
  }
  ctx.session.viewCount++
  ctx.body = {
    errno: 0,
    viewCount: ctx.session.viewCount
  }
})

module.exports = router