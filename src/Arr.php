<?php
/**
 * @desc 数组助手类
 */
namespace PhalconHelpers;

use Phalcon\Text;

class Arr
{

    /**
     * 将数组中键名下划线转换为驼峰
     * 
     * @param array $arr            
     * @param string $delimiter
     *            字符分隔符
     * @param bool $lcfirst
     *            首字母是否小写
     * @return mixed
     */
    public static function camelize(array $array, string $delimiter = '_', bool $lcfirst = true)
    {
        foreach ($array as $key => $value) {
            $k = $key;
            $k = Text::camelize($k);
            $lcfirst && $k = lcfirst($k);
            if ($key != $k) {
                unset($array[$key]);
            }
            if (is_array($value)) {
                $value = static::camelize($value, $delimiter, $lcfirst);
            }
            $array[$k] = $value;
        }
        return $array;
    }
}