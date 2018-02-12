<?php
/**
 * Created by PhpStorm
 * PROJECT: TOOL
 * User: Doing<vip.dulin@gmail.com>
 * Date: 2018年2月12日
 * Desc:常用算法
 */

/**生成指定长度的随机字符串
 * @param $ length 指定字符串长度
 * @return null|string
 */
function getRandChar($length)
{
    $str = null;
    $strPol = "ABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789abcdefghijklmnopqrstuvwxyz";
    $max = strlen($strPol) - 1;

    for ($i = 0;
         $i < $length;
         $i++) {
        $str .= $strPol[rand(0, $max)];
    }

    return $str;
}