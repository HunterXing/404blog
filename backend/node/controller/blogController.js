const { exec } = require('./../db/mysql')

// 得到博客列表
const getList = (author, keyword) => {
    let sql = `select * from tb_blogs, tb_users where tb_blogs.author_id=tb_users.id `
    if (author) {
        sql += `and author='${author}' `
    }
    if (keyword) {
        sql += `and title like '%${keyword}%' `
    }
    sql += `order by createtime desc;`

    // 返回 promise
    return exec(sql)
}

// 得到自己的博客
const getMyArticle = () => {
    // let sql = ` select * from `
}
// 得到博客详情

// 删除博客

module.exports = {
    getList
}