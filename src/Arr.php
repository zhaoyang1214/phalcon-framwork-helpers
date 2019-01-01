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

    /**
     * 根据一组一维数组的值取另一个多维数组对应键名的值并组成新数组
     *
     * @param array $keys
     *            一维数组
     * @param array $array
     *            多维数组
     * @param bool $setNull
     *            键名在数组中不存在时是否加入返回数组
     * @return array
     */
    public static function extract(array $keys, array $array, bool $setNull = false)
    {
        $newArray = [];
        foreach ($keys as $key) {
            if (array_key_exists($key, $array)) {
                $newArray[$key] = $array[$key];
            } else if ($setNull) {
                $newArray[$key] = null;
            }
        }
        return $newArray;
    }
}