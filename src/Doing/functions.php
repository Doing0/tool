<?php
/**
 * Created by PhpStorm
 * PROJECT: TOOL
 * User: Doing<vip.dulin@gmail.com>
 * Date: 2018年2月12日
 * Desc:常用算法
 */

/**生成指定长度的随机字符串
 *
 * @param int $length
 *
 * @return null|string
 */
function getRandChar($length = 32)
{
    $str = null;
    $strPol = "ABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789abcdefghijklmnopqrstuvwxyz";
    $max = strlen($strPol) - 1;
    for ($i = 0; $i < $length; $i++)
    {
        $str .= $strPol[rand(0, $max)];
    }
    return $str;
}//fun

/**
 * 二维数组按指定字段进行排序
 *
 * @param $array2D二维数组
 * @param $field指定字段排序
 * @param string $sortby 排序方式
 *
 * @return array|bool
 */
function array2DSortByField($array2D, $field, $sortby = 'asc')
{
    if (is_array($array2D))
    {
        $refer = $resultSet = [];
        foreach ($array2D as $i => $data)
        {
            $refer[$i] = &$data[$field];
        }
        switch ($sortby)
        {
            case 'asc': // 正向排序
                asort($refer);
                break;
            case 'desc': // 逆向排序
                arsort($refer);
                break;
            case 'nat': // 自然排序
                natcasesort($refer);
                break;
        }
        foreach ($refer as $key => $val)
        {
            $resultSet[] = &$array2D[$key];
        }
        return $resultSet;
    }
    return false;
}//fun

/**计算两点的距离:
 *
 * @param $myY我的经度
 * @param $myX我的维度
 * @param $targetY目标经度
 * @param $targetX目标维度
 *
 * @return float km
 */
function getDistanceByCoordinate($myY, $myX, $targetY, $targetX)
{
    $earthRadius = 6367000; //approximate radius of earth in meters
    $myY = ($myY * pi()) / 180;
    $myX = ($myX * pi()) / 180;
    $targetY = ($targetY * pi()) / 180;
    $targetX = ($targetX * pi()) / 180;
    $distanceX = $targetX - $myX;
    $distanceY = $targetY - $myY;
    $stepOne = pow(sin($distanceY / 2), 2) + cos($myY) * cos($targetX) * pow
        (sin($distanceX / 2), 2);
    $stepTwo = 2 * asin(min(1, sqrt($stepOne)));
    $calculatedDistance = $earthRadius * $stepTwo;
    return round($calculatedDistance) / 1000;
}

/**颜色进度转换16进制样式转rgb
 * @param $colour16进制颜色eg:#fff
 * @return $array
 */
function hexToRGB($colour)
{
    if ($colour[0] == '#')
    {
        $colour = substr($colour, 1);
    }
    if (strlen($colour) == 6)
    {
        list($r, $g, $b) = [$colour[0] . $colour[1], $colour[2] .
            $colour[3], $colour[4] . $colour[5]];
    }elseif (strlen($colour) == 3)
    {
        list($r, $g, $b) = [$colour[0] . $colour[0], $colour[1] .
            $colour[1], $colour[2] . $colour[2]];
    }else
    {
        return false;
    }
    $r = hexdec($r);
    $g = hexdec($g);
    $b = hexdec($b);
    return ['red' => $r, 'green' => $g, 'blue' => $b];

}

