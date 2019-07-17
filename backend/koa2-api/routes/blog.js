const router = require('koa-router')()

router.prefix('/api/blog')

// 登录验证中间件
const loginCheck = require('../middleware/loginCheck')
const {
  getList,
  getBlogDetail,
  getEditArticle,
  editArticle,
  getMyArticle,
  addArticle,
  delArticle,
  addview
} = require('../controller/blogController')
const {
  SuccessModel,
  ErrorModel
} = require('../model/resModel')

// blog列表 / 搜索
router.get('/list', async (ctx, next) => {
  // res.render('index', { title: 'Express' });
  let author = ctx.request.body.author || ''
  let keyword = ctx.request.body.keyword || ''
  const listData = await getList(author, keyword)
  ctx.body = new SuccessModel(listData)
});

// 得到自己的博客
router.post('/getMyArticle',loginCheck, async (ctx, next) =>{
  let username = ctx.session.username
  const listData = await getMyArticle(username)
  if (listData) {
    ctx.body = new SuccessModel(listData)
  } else {
    ctx.body = new ErrorModel("获取博客失败")
  }
  
})

// blog详情
router.post('/detail', async (ctx, next) => {
  // res.render('index', { title: 'Express' });
  let blogId = ctx.request.body.blogId || ''
  console.log('-------------------------',blogId)
  const resulistData = await getBlogDetail(blogId)
  console.log('-------------------',resulistData);
  ctx.body = new SuccessModel(resulistData)
});


// 添加
router.post('/addArticle',loginCheck, async (ctx, next) => {
  let { title, content, link, author_id, markdown,type } = getBlogDetail.body
  const result = await addArticle(title, content, link, author_id,markdown,type)
  ctx.body = new SuccessModel(result)
})

// 得到需要编辑的博客的详情
router.post('/getEditArticle', loginCheck,async (ctx, next) => {
  let blogId = ctx.request.body.blogId || ''
  const result = await getEditArticle(blogId)
  ctx.body = new SuccessModel(result)
})

// 编辑博客 （更新）
router.post('/editArticle', loginCheck,async (ctx, next) => {
  let blogId = ctx.request.body.blogId || ''
 
  let {
    title,
    detail,
    type,
    link,
    markdown
  } = ctx.request.body
  console.log('type', type)
  const result = await editArticle(blogId, title, detail, type, link, markdown)
  ctx.body = new SuccessModel(result)
//   return result.then(val => {
//     if (val) {
//       res.json(
//         new SuccessModel('更新博客成功')
//       )
//     } else {
//       res.json(
//         new ErrorModel('编辑博客失败')
//       )
//     }
//   })
})

// 删除
router.post('/delArticle', loginCheck, async (ctx, next) => {
  let blogId  = ctx.request.body.blogId
  const result = await delArticle(blogId)
  ctx.body = new SuccessModel(result)
//   return result.then(val => {
//     if (val) {
//       res.json(
//         new SuccessModel('删除博客成功')
//       )
//     } else {
//       res.json(
//         new ErrorModel('删除博客失败')
//       )
//     }
//   })
})


// 添加浏览人数
router.post('/addview',async (ctx,next) => {
  let blogId = ctx.request.body.blogId
  const result = await addview(blogId)
  ctx.body = new SuccessModel(result)
//   return result.then(val => {
//     if (val) {
//       res.json(
//         new SuccessModel()
//       )
//     } else {
//       res.json(
//         new ErrorModel()
//       )
//     }
//   }).catch(err => {
//     console.log(err)
//   })
})



module.exports = router;