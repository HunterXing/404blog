const {
    exec,
    escape
} = require('./../db/mysql')
const { timestampToTime } = require('../utils/data')
// 得到博客推荐列表
const getList = async (author, keyword) => {
    let sql =
        `select * , tb_blogs.id as articleid
            from tb_blogs, tb_users 
            where tb_blogs.author_id=tb_users.id 
            and tb_blogs.show=1
        `
    if (author) {
        author = escape(author) 
        sql += `and author=${author} `
    }
    if (keyword) {
        keyword = escape(keyword) 
        sql += `and title like %${keyword}% `
    }
    sql += `order by tb_blogs.createtime desc;`
    console.log(sql)
    // 返回 promise
    return await exec(sql)
}

// 得到自己的博客
const getMyArticle = async (username) => {
    let sql =
        `
     select *, tb_blogs.id as articleid
        from tb_blogs, tb_users 
        where tb_blogs.author_id=tb_users.id
        and tb_users.username= '${username}' 
        and tb_blogs.show=1 
        order by tb_blogs.createtime desc;
    `
    // console.log(sql)
    const rows = await exec(sql)
    return rows

}
// 得到博客详情
const getBlogDetail = async (blogId) => {
    let sql =
     `select * 
        from tb_blogs, tb_users 
        where tb_blogs.author_id=tb_users.id 
        and tb_blogs.id='${blogId}'
     `
     console.log(sql)
    // 返回 promise
    let data = await exec(sql)
    // console.log(data)
    return data[0]
}
// 得到需要编辑的博客的详情
const getEditArticle = async (blogId) => {
    let sql =
        `
    select * from tb_blogs where id = ${blogId}
    `
    // console.log(sql)
    const rows = await exec(sql)
    return  rows[0] || {}


}
// 编辑博客
const editArticle = async (blogId, title, detail, type, link, markdown) => {
    detail = escape(detail)
    markdown = escape(markdown)
   
    title = escape(title)
    // console.log(typeof(type),type)
    if (type === 0 + '') {
        link = ''
    }
    link = escape(link)
    let sql =
        `
    update tb_blogs
    set
        title = ${title},
        content =${detail},
        type =  ${type},
        link = ${link},
        markdown =${markdown}
    where id = ${blogId}
    `
    console.log(sql)
    let updateData = await exec(sql)
    if (updateData.affectedRows > 0) {
        return true
    }
    return false
}

// 添加博客
const addArticle = async (title, content, link, author_id,markdown,type) => {
    content = escape(content)
    markdown = escape(markdown)
    title = escape(title)
    link = escape(link)
    let createtime = timestampToTime(Date.now())
    let sql =
    `
        insert into tb_blogs (title, content, link, createtime, author_id, markdown, type)
        values (${title}, ${content}, ${link}, '${createtime}', '${author_id}', ${markdown}, '${type}');
    `
    console.log(sql)
    let insertData = await exec(sql)
    return {
        id: insertData.insertId
    }
}

// 删除博客
const delArticle = async (blogId) => {
     // id 就是要删除博客的 id
    //  const sql = `delete from tb_blogs where id='${id}' and author='${author}';`
    //  return exec(sql).then(delData => {
    //      // console.log('delData is ', delData)
    //      if (delData.affectedRows > 0) {
    //          return true
    //      }
    //      return false
    //  })

    // 软删除
    let sql =
        `
    update tb_blogs
    set
        tb_blogs.show = 0
    where id = ${blogId}
    `
    console.log(sql)
    let updateData = await exec(sql)
    if (updateData.affectedRows > 0) {
        return true
    }
    return false
}

// 浏览人数添加
const addview =async (blogId) => {
    let sql =
    `
        update tb_blogs
        set
           tb_blogs.preview = tb_blogs.preview + 1
           where id = ${blogId}
    `
    // console.log(sql)
    let updateData = await exec(sql)
    if (updateData.affectedRows > 0) {
        return true
    } 
    return false
}

module.exports = {
    getList,
    getBlogDetail,
    getEditArticle,
    editArticle,
    getMyArticle,
    addArticle,
    delArticle,
    addview
}