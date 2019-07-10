var express = require('express');
var router = express.Router();
const {
    login,
    userInfo
} = require('../controller/userController')
const {
    SuccessModel,
    ErrorModel
} = require('../model/resModel')

// 登录
router.post('/login', function (req, res, next) {
    const {
        username,
        password
    } = req.body
    const result = login(username, password)
    return result.then(data => {
        if (data.username) {
            // 设置 session
            // req.session  = {}
            req.session.username = data.username; // 登录成功，设置 session
            req.session.realname = data.realname
            console.log(req.session)
            // req.session.realname = data.realname
            res.json(
                new SuccessModel('登录成功')
            )
            return
        }
        res.json(
            new ErrorModel('登录失败')
        )
    })
});

// 退出
router.get('/exit', function (req, res, next) {
    let result = delete req.session.username
    console.log('exit:', result)
    if (result) {
        res.json(
            new SuccessModel('退出成功')
        );
    } else {
        res.json(
            new SuccessModel('退出失败')
        );
    }
});

// // 测试session
// router.get('/session-test', (req, res, next) => {
//     let session = req.session
//     console.log('session is :', session)
// })

// 登录验证
router.get('/loginCheck', (req, res, next) => {
    if (req.session.username) {
        const result = userInfo(req.session.username)
        return result.then(data => {
            data.isLogin = true
            res.json(
                new SuccessModel(data)
            )
        })
    }
    res.json(
        new ErrorModel('未登录')
    )
})



module.exports = router;