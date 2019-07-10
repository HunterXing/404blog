var express = require('express');
var router = express.Router();
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
router.get('/list', (req, res, next) => {
  // res.render('index', { title: 'Express' });
  let author = req.body.author || ''
  let keyword = req.body.keyword || ''
  const result = getList(author, keyword)
  return result.then(listData => {
    res.json(
      new SuccessModel(listData)
    )
  })
});

// 得到自己的博客
router.post('/getMyArticle',loginCheck, (req, res, next) =>{
  let username = req.session.username
  const result = getMyArticle(username)
  return result.then(listData => {
    res.json(
      new SuccessModel(listData)
    )
  })
})

// blog详情
router.post('/detail', (req, res, next) => {
  // res.render('index', { title: 'Express' });
  let blogId = req.body.blogId || ''
  const result = getBlogDetail(blogId)
  return result.then(listData => {
    res.json(
      new SuccessModel(listData[0])
    )
  })
});


// 添加
router.post('/addArticle',loginCheck, (req, res, next) => {
  let { title, content, link, author_id, markdown,type } = req.body
  const result = addArticle(title, content, link, author_id,markdown,type)
  return result.then(listData=> {
    res.json(
      new SuccessModel(listData,'添加文章成功')
    )
  }).catch(err=>{
    res.json(
      new ErrorModel(err,'添加文章失败')
    )
  })
})

// 得到需要编辑的博客的详情
router.post('/getEditArticle', loginCheck, (req, res, next) => {
  let blogId = req.body.blogId || ''
  const result = getEditArticle(blogId)
  return result.then(listData => {
    res.json(
      new SuccessModel(listData)
    )
  })
})

// 编辑博客 （更新）
router.post('/editArticle', loginCheck, (req, res, next) => {
  let blogId = req.body.blogId || ''
 
  let {
    title,
    detail,
    type,
    link,
    markdown
  } = req.body
  console.log('type', type)
  const result = editArticle(blogId, title, detail, type, link, markdown)
  return result.then(val => {
    if (val) {
      res.json(
        new SuccessModel('更新博客成功')
      )
    } else {
      res.json(
        new ErrorModel('编辑博客失败')
      )
    }
  })
})

// 删除
router.post('/delArticle', loginCheck, (req, res, next) => {
  let blogId  = req.body.blogId
  const result = delArticle(blogId)
  return result.then(val => {
    if (val) {
      res.json(
        new SuccessModel('删除博客成功')
      )
    } else {
      res.json(
        new ErrorModel('删除博客失败')
      )
    }
  })
})


// 添加浏览人数
router.post('/addview', (req,res,next) => {
  let blogId = req.body.blogId
  const result = addview(blogId)
  return result.then(val => {
    if (val) {
      res.json(
        new SuccessModel()
      )
    } else {
      res.json(
        new ErrorModel()
      )
    }
  }).catch(err => {
    console.log(err)
  })
})



module.exports = router;