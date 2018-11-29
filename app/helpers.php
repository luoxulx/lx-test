<?php
/**
 * Created by PhpStorm.
 * User: luoxulx
 * Date: 2018/10/17
 * Time: 下午23:29
 */

if (! function_exists('operationColor')) {
	function operationColor($method)
	{
		$array = \App\Models\OperationLog::$methodColors;
		return array_get($array, $method, 'grey');
	}
}


if (! function_exists('randomFloat')) {
    function randomFloat($min = 0, $max = 1) {
        return $min + mt_rand() / mt_getrandmax() * ($max - $min);
    }
}

if (! function_exists('getFileSuffix')) {
    function getFileSuffix($fileUrl) {
        $tempArr =  pathinfo($fileUrl);
        return $tempArr['extension'];
    }
}


if (! function_exists('isEnglish')) {
    /**
     * @param $value
     * @return int
     */
    function isEnglish($value) {
        return eregi('[a-zA-Z]', $value);
    }
}

if (!function_exists('v4UUID')) {
    function v4UUID($namespace = '')
    {
        $guid = '';
        $uuid = uniqid('laravel_', true);
        $temp = $namespace ?? str_random();

        $temp .= $_SERVER['REQUEST_TIME'];
        $temp .= $_SERVER['HTTP_USER_AGENT'];
        $temp .= $_SERVER['LOCAL_ADDR'] ?? '127.0.0.1';
        $temp .= $_SERVER['LOCAL_PORT'] ?? '2556';
        $temp .= $_SERVER['REMOTE_ADDR'];
        $temp .= $_SERVER['REMOTE_PORT'];

        $hash_value = strtoupper(hash('ripemd160', $uuid . $guid . md5($temp)));

        return substr($hash_value,0,8) . '-' .
            substr($hash_value,8,4) . '-' .
            substr($hash_value,12,4) . '-' .
            substr($hash_value,16,4) . '-' .
            substr($hash_value,20,12);
    }
}


if (! function_exists('filterEmoji')) {
    function filterEmoji($string)
    {
        $str = preg_replace_callback(
            '/./u',
            function (array $match) {
                return strlen($match[0]) >= 4 ? '' : $match[0];
            },
            $string);

        return $str;
    }
}
