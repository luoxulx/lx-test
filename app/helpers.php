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
