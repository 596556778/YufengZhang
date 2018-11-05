<?php
return [
    'PROJECT_NAME' => 'zhang',

    /* 忽略大小写 */
    'URL_CASE_INSENSITIVE' => true,
    /*2 Rewrite模式，url重写->.htccess Apache配置  */
    'URL_MODEL' => 2,
    /* 配置文件加载Conf/*.php*/
    'LOAD_EXT_CONFIG' => 'db',
    /* 默认跳转目录*/
    'DEFAULT_MODULE' => 'Client',
    
    'MODULE_ALLOW_LIST' => ['Admin','Client','Common'],
    
    /* 命名空间定义 */
    'AUTOLOAD_NAMESPACE' => [
       
    ],

    'URL_ROUTER_ON' => true,
    'SESSION_AUTO_START' => false,
   

    /* 默认上传方式 */
    'UPLOAD_TYPE_CONFIG' => 'Local',
    /* 系统配置缓存名 */
    'SETTING_CACHE_NAME' => 'sys_config',
    
    'UPLOAD_DIR' => 'upload',

    
    /* 用于验证的用户表 */
    'ADMIN_AUTH_MODEL' => 'AdminUser',
    'HOME_AUTH_MODEL' => 'User',

];