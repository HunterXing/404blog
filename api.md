# 项目的需求和Api
- 登录

  ```
  api/user/login
  /interface/index.php/Home/Login/index
  ```

  | 参数名   | 描述   |
  | -------- | ------ |
  | username | 用户名 |
  | password | 密码   |

  

- 我的所有文章首页

  ```
  api/user/login
  ```

  | 参数名   | 描述   |
  | -------- | ------ |
  | username | 用户名 |
  | password | 密码   |


- 推荐

  ```
  api/user/login
  ```

  | 参数名   | 描述   |
  | -------- | ------ |
  | username | 用户名 |
  | password | 密码   |

- 写文章

  - 保存文章
  - 发布文章

  ```
  api/user/login
  ```

  | 参数名   | 描述   |
  | -------- | ------ |
  | username | 用户名 |
  | password | 密码   |



- 编辑文章

  ​	

    ```
    api/user/login
    ```

  | 参数名   | 描述   |
  | -------- | ------ |
  | username | 用户名 |
  | password | 密码   |

- 删除文章

  ```
  api/user/login
  ```

  | 参数名   | 描述   |
  | -------- | ------ |
  | username | 用户名 |
  | password | 密码   |

- 查看文章

  ```
  api/user/login
  ```

  | 参数名   | 描述   |
  | -------- | ------ |
  | username | 用户名 |
  | password | 密码   |



# 数据库设计

users

| 字段     | 描述   |
| -------- | ------ |
| id       | 用户id |
| username | 用户名 |
| password | 密码   |
| job      | 职业   |
|          |        |

blogs


| 字段           | 描述          |
| -------------- | ------------- |
| id             | 博客id        |
| author_id      | 外键 user的id |
| title          | 文章标题      |
| create_time    | 创建时间      |
| detail         | 详细内容      |
| preview_number | 浏览量        |
|                |               |
|                |               |