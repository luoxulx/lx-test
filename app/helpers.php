<?php
/**
 * Created by PhpStorm.
 * User: luoxulx
 * Date: 2018/10/17
 * Time: 下午23:29
 */

if (! function_exists('test')) {
    function test()
    {
        return 1;
    }
}

if (! function_exists('xxx')) {
	function xxx($method)
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

