var express = require('express');
var router = express.Router();

const { getList } = require('../controller/blogController')
const { SuccessModel, ErrorModel } = require('../model/resModel')
// blog列表 / 搜索
router.get('/list', function(req, res, next) {
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

// blog详情

// 添加

// 更新

// 删除



module.exports = router;
