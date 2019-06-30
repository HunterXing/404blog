<?php
return array(
	//'配置项'=>'配置值'
	 //模版常量
	 'TMPL_PARSE_STRING' => array(
		'__UPLOAD__'  => __ROOT__.'/Public/Upload',
		'__DATA__' => __ROOT__.'/index.php/home',
		'__SMS__' => __ROOT__.'/qcloudsms_php'
	),


		/* 数据库设置 */
	  	'DB_TYPE'               =>  'mysqli',     	 // 数据库类型
		'DB_HOST'             =>  'localhost', 	 // 服务器地址		
		'DB_NAME'               =>  'db_myblog',         // 数据库名
		'DB_USER'               =>  'root',      	 // 用户名
		'DB_PWD'                =>  '',          // 密码
		'DB_PORT'               =>  '3306',          // 端口
		'DB_PREFIX'             =>  'tb_',    		 // 数据库表前缀

		// 'DB_TYPE'               =>  'mysqli',     	 // 数据库类型
		// 'DB_HOST'             =>  '212.64.25.152', 	 // 服务器地址		
		// 'DB_NAME'               =>  'db_myblog',         // 数据库名
		// 'DB_USER'               =>  'heng',      	 // 用户名
		// 'DB_PWD'                =>  'xinghenga',          // 密码
		// 'DB_PORT'               =>  '3306',          // 端口
		// 'DB_PREFIX'             =>  'tb_',    		 // 数据库表前缀
);