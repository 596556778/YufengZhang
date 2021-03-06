<?php

namespace Think\Upload\Driver;

use OSS\OssClient;
use OSS\OssException;
use OSS\Core\OssUtil;

class Oss
{
    /**
     * 上传文件根目录
     * @var string
     */
    private $rootPath;

    /**
     * 上传错误信息
     * @var string
     */
    private $error = '';

    private $defaultBucket = '';
    private $client = null;

    private $config = array(
    );

    /**
     * 构造函数，用于设置上传根路径
     * @param array  $config FTP配置
     */
    public function __construct($config)
    {
        $this->config = $config;
        try {
            $this->client = new OssClient($config['access_key_id'], $config['access_key_secret'], $config['endpoint']);
            $this->defaultBucket = $config['bucket'];
        } catch (OssException $e) {
            $this->error = $e->getMessage();
        }


        // $this->qiniu = new QiniuStorage($config);
    }

    /**
     * 检测上传根目录(OSS上传时支持自动创建目录，直接返回)
     * @param string $rootpath   根目录
     * @return boolean true-检测通过，false-检测失败
     */
    public function checkRootPath($rootpath)
    {
        $this->rootPath = trim($rootpath);
        return true;
    }

    /**
     * 检测上传目录(OSS上传时支持自动创建目录，直接返回)
     * @param  string $savepath 上传目录
     * @return boolean          检测结果，true-通过，false-失败
     */
    public function checkSavePath($savepath)
    {
        return true;
    }

    /**
     * 创建文件夹 (OSS上传时支持自动创建目录，直接返回)
     * @param  string $savepath 目录名称
     * @return boolean          true-创建成功，false-创建失败
     */
    public function mkdir($savepath)
    {
        return true;
    }

    /**
     * 保存指定文件
     * @param  array   $file    保存的文件信息
     * @param  boolean $replace 同名文件是否覆盖
     * @return boolean          保存状态，true-成功，false-失败
     */
    public function save(&$file, $replace = true)
    {

        $object = implode('/', array_filter([$this->rootPath, $file['savepath'], $file['savename']], function($val) {
            return $val !== '';
        }));

        try {
            $options = [
                'Content-Type' => $file['type'],
                'Content-Length' => $file['size'],
            ];
            $ret = $this->client->uploadFile($this->defaultBucket, $object, $file['tmp_name'], $options);
            $file['url'] = $ret['info']['url'];
            return true;
        } catch (OssException $e) {
            $this->error = $e->getMessage();
        }
    }

    /**
     * 获取最后一次上传错误信息
     * @return string 错误信息
     */
    public function getError()
    {
        return $this->error;
    }

}
