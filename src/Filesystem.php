<?php
/**
 * @desc 文件系统助手类
 */
namespace PhalconHelpers;

class Filesystem
{

    /**
     * 格式化目录
     * 
     * @param string $path            
     * @return : string
     */
    public static function dirFormat(string $path)
    {
        $path = str_replace('\\', '/', $path);
        $path = preg_replace_callback('/(\{.+\})/U', function ($matches) {
            return date(rtrim(ltrim($matches[0], '{'), '}'));
        }, $path);
        return $path;
    }

    /**
     * 创建目录
     * 
     * @param string $pathname
     *            路径
     * @param int $mode
     *            文件夹权限默认情况下，模式是0777
     * @param bool $recursive
     *            规定是否设置递归模式
     * @param resource $context
     *            规定文件句柄的环境。Context 是可修改流的行为的一套选项。
     * @return bool
     */
    public static function mkdir(string $pathname, int $mode = 0777, bool $recursive = true, $context = null)
    {
        if (empty($pathname) || is_file($pathname)) {
            return false;
        }
        if (is_dir($pathname)) {
            return true;
        }
        return is_resource($context) ? mkdir($pathname, $mode, $recursive, $context) : mkdir($pathname, $mode, $recursive);
    }
}