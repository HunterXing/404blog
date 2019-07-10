const {
    exec
} = require('./../db/mysql')

// 得到博客推荐列表
const getList = (author, keyword) => {
    let sql =
        `select * , tb_blogs.id as articleid
    from tb_blogs, tb_users 
    where tb_blogs.author_id=tb_users.id 
    and tb_blogs.show=1
    `
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
const getMyArticle = (username) => {
    let sql =
        `
     select *, tb_blogs.id as articleid
        from tb_blogs, tb_users 
        where tb_blogs.author_id=tb_users.id
        and tb_users.username= '${username}' 
        and tb_blogs.show=1
    `
    // console.log(sql)
    return exec(sql).then(rows => {
        return rows || {}
    })

}
// 得到博客详情
const getBlogDetail = (blogId) => {
    let sql =
     `select * 
        from tb_blogs, tb_users 
        where tb_blogs.author_id=tb_users.id 
        and tb_blogs.id='${blogId}'
     `
    //  console.log(sql)
    // 返回 promise
    return exec(sql)
}
// 得到需要编辑的博客的详情
const getEditArticle = (blogId) => {
    let sql =
        `
    select * from tb_blogs where id = ${blogId}
    `
    // console.log(sql)
    return exec(sql).then(rows => {
        return rows[0] || {}
    })

}
// 编辑博客
const editArticle = (blogId, title, detail, type, link, markdown) => {

    // console.log(typeof(type),type)
    if (type === 0 + '') {
        link = ''
    }
    let sql =
        `
    update tb_blogs
    set
        title = '${title}',
        content ='${detail}',
        type =  ${type},
        link ='${link}',
        markdown ='${markdown}'
    where id = ${blogId}
    `
    // console.log(sql)
    return exec(sql).then(updateData => {
        // console.log('updateData is ', updateData)
        if (updateData.affectedRows > 0) {
            return true
        }
        return false
    })
}

// 添加博客
const addArticle = (title, content, link, author_id,markdown,type) => {
    let createtime = Date.now()
    let sql =
    `
        insert into tb_blogs (title, content, link, createtime, author_id, markdown, type)
        values ('${title}', '${content}', '${link}', '${createtime}', '${author_id}', '${markdown}', '${type}');
    `
    console.log(sql)
    return exec(sql).then(insertData => {
        // console.log('insertData is ', insertData)
        return {
            id: insertData.insertId
        }
    })
}

// 删除博客
const delArticle = (blogId) => {
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
    return exec(sql).then(updateData => {
        // console.log('updateData is ', updateData)
        if (updateData.affectedRows > 0) {
            return true
        }
        return false
    })
}

// 浏览人数添加
const addview = (blogId) => {
    let sql =
    `
        update tb_blogs
        set
           tb_blogs.preview = tb_blogs.preview + 1
           where id = ${blogId}
    `
    console.log(sql)
    return exec(sql).then(updateData => {
        // console.log('updateData is ', updateData)
        if (updateData.affectedRows > 0) {
            return true
        }
        return false
    })

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