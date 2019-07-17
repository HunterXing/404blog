const crypto = require('crypto')

// 密匙
const SECRET_KEY = '?WJiol_8776#'

// 加密函数
function md5(content) {
    let md5 = crypto.createHash('md5')
    return md5.update(content).digest('hex')
}

// 生成加密后的密码
function genPassword(password) {
    const str = `password=${password}&key=${SECRET_KEY}`
    return md5(str)
}

// console.log(genPassword(123))
module.exports = {
    genPassword
}