<?php
return array(
	//'配置项'=>'配置值'
	 //模版常量
	 'TMPL_PARSE_STRING' => array(
		'__UPLOAD__'  => __ROOT__.'/Public/Upload',
		'__HOME__' => __ROOT__.'/Public/Home',
		'__ADMIN__'  => __ROOT__.'/Public/Admin',
		'__DATA__' => __ROOT__.'/index.php/home',
		'__SMS__' => __ROOT__.'/qcloudsms_php'
	),

		/* 数据库设置 */
	  'DB_TYPE'               =>  'mysql',     	 // 数据库类型
	/*    'DB_HOST'             =>  'localhost', 	 // 服务器地址*/
		'DB_HOST'               =>  '212.64.25.152', 	 // 服务器地址
		'DB_NAME'               =>  'db_mifeng',         // 数据库名
		'DB_USER'               =>  'mifeng',      	 // 用户名
		'DB_PWD'                =>  'mifeng123',          // 密码
	/*    'DB_USER'               =>  'root',      	 // 用户名
		'DB_PWD'                =>  'root',          // 密码*/
		'DB_PORT'               =>  '3306',          // 端口
		'DB_PREFIX'             =>  'tb_',    		 // 数据库表前缀
);