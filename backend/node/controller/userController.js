const { exec, escape } = require('../db/mysql')
const { genPassword } = require('../utils/cryps')

// 登录
const login = (username, password) => {
    username = escape(username)
    
    // 生成加密密码
    password = genPassword(password)
    password = escape(password)

    const sql = 
    `
        select * from tb_users where username=${username} and password=${password}
    `
    // console.log('sql is', sql)
    return exec(sql).then(rows => {
        return rows[0] || {}
    })
}



// 用户信息
const userInfo = (username) => {
    username = escape(username)
    const sql = 
    `
        select tb_users.id ,username  from tb_users where username=${username}
    `
    // console.log('sql is', sql) 
    return exec(sql).then(rows => {
        return rows[0] || {}
    })
}

module.exports = {
    login,
    userInfo
}