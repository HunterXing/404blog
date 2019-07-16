# 项目的需求和Api
- 登录

  ```
  api/user/login           post
  ```

  | 参数名   | 描述   |
  | -------- | ------ |
  | username | 用户名 |
  | password | 密码   |

  
- 退出

  ```
  api/user/exit             get
  ```
  `不需要参数`


- 登录验证

  ```
  api/user/loginCheck       get
  ```
  `不需要参数`


- 我的所有文章首页

  ```
  api/blog/list             get
  ```

  | 参数名   | 描述   |
  | -------- | ------ |
  | author | 用户名 |
  | keyword | 关键词   |

- 推荐文章

  ```
  api/blog/getMyArticle      post
  ```
  `不需要参数`

- 文章详情

  ```
  api/blog/detail            post
  ```

  | 参数名   | 描述   |
  | -------- | ------ |
  | blogId | 博客的id |


- 添加文章

  ```
  api/blog/addArticle        post
  ```

  | 参数名   | 描述   |
  | -------- | ------ |
  | title | 博客的标题 |
  | content | 博客的内容 |
  | link | 博客转载的链接 |
  | author_id | 作者的id |
  | markdown | 博客的markdown文档内容 |
  | type | 博客的类型 转载或者原创 |



- 得到需要编辑文章的详情

    ```
    api/blog/getEditArticle     post
    ```

  | 参数名   | 描述   |
  | -------- | ------ |
  | blogId | 博客的id |


- 编辑文章

    ```
    api/blog/editArticle      post
    ```

  | 参数名   | 描述   |
  | -------- | ------ |
  | blogId | 博客的id |
  | title | 博客的标题 |
  | detail | 博客的内容 |
  | link | 博客转载的链接 |
  | markdown | 博客的markdown文档内容 |
  | type | 博客的类型 转载或者原创 |


- 删除文章

  ```
  api/blog/delArticle            post
  ```

  | 参数名   | 描述   |
  | -------- | ------ |
  | blogId | 博客的id |

- 增加文章的预览人数

  ```
  api/blog/addview               post
  ```

  | 参数名   | 描述   |
  | -------- | ------ |
  | blogId | 博客的id |



# 数据库设计

tb_users

| 字段     | 描述   |
| -------- | ------ |
| id       | 用户id |
| username | 用户名 |
| password | 密码   |
| job      | 职业   |
|          |        |

tb_blogs


| 字段           | 描述          |
| -------------- | ------------- |
| id             | 博客id        |
| author_id      | 外键 user的id |
| title          | 文章标题      |
| create_time    | 创建时间      |
| detail         | 详细内容      |
| preview_number | 浏览量        |
| state          | 状态 0 删除 1 展示   |
| show | 状态 0 删除 1 展示 |
| type | 0 原创  1转载 |
| link | 转载链接 |