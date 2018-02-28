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
 *
 * @param $colour16进制颜色eg :#fff
 *
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

/**
 * 将xml转为array
 *
 * @param string $xml
 * return array
 */
function xmlToArray($xml)
{
    libxml_disable_entity_loader(true);
    $values = json_decode(json_encode(simplexml_load_string($xml, 'SimpleXMLElement', LIBXML_NOCDATA)), true);
    return $values;
}//fun
/**模拟http请求
 *
 * @param string $url 请求地址
 * @param array|json $ data 请求参数:根据接口要求传json还是数组
 * @param string $type 请求方式POST/GET
 * @param bool $header 头部信息如token return "Authorization:Bearer
 *     ".$tokenResult['access_token'];
 *
 * @return mixed
 */
function postCurl($url = '', $type = "POST", $data = '', $header = false)
{
    #1.创建一个curl资源
    $ch = curl_init();
    #2.设置URL和相应的选项
    //2.1设置url
    curl_setopt($ch, CURLOPT_URL, $url);
    //2.2设置头部信息
    //array_push($header, 'Accept:application/json');
    //array_push($header,'Content-Type:application/json');
    //array_push($header, 'http:multipart/form-data');
    //设置为false,只会获得响应的正文(true的话会连响应头一并获取到)
    curl_setopt($ch, CURLOPT_HEADER, 0);
    //curl_setopt ( $ch, CURLOPT_TIMEOUT,5); // 设置超时限制防止死循环
    //设置发起连接前的等待时间，如果设置为0，则无限等待。
    curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, 5);
    //将curl_exec()获取的信息以文件流的形式返回，而不是直接输出。
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    #3设置请求参数
    if ($data)
    {
        //全部数据使用HTTP协议中的"POST"操作来发送。
        curl_setopt($ch, CURLOPT_POSTFIELDS, $data);
    }
    //3)设置提交方式
    switch ($type)
    {
        case "GET":
            curl_setopt($ch, CURLOPT_HTTPGET, true);
            break;
        case "POST":
            curl_setopt($ch, CURLOPT_POST, true);
            break;
        case "PUT"://使用一个自定义的请求信息来代替"GET"或"HEAD"作为HTTP请求。这对于执行"DELETE" 或者其他更隐蔽的HTT
            curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "PUT");
            break;
        case "DELETE":
            curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "DELETE");
            break;
    }
    //4.设置请求头 如果有才设置
    if ($header)
    {
        curl_setopt($ch, CURLOPT_HTTPHEADER, $header);
    }
    #5.上传文件相关设置
    curl_setopt($ch, CURLOPT_FOLLOWLOCATION, true);
    curl_setopt($ch, CURLOPT_MAXREDIRS, 3);
    // 对认证证书来源的检查
    curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, FALSE);
    // 从证书中检查SSL加密算
    curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, FALSE);


    #6.在HTTP请求中包含一个"User-Agent: "头的字符串。-----必设
    //curl_setopt($ch, CURLOPT_USERAGENT, 'SSTS Browser/1.0');
    //curl_setopt($ch, CURLOPT_ENCODING, 'gzip');
    //6.2=1模拟用户使用的浏览器
    curl_setopt($ch, CURLOPT_USERAGENT, 'Mozilla/4.0 (compatible; MSIE 8.0; Windows NT 6.0; Trident/4.0)');
    #7.抓取URL并把它传递给浏览器
    $result = curl_exec($ch);
    #8关闭curl资源，并且释放系统资源
    curl_close($ch);
    return $result;
}//fun
/**拼接url请求参数:把数组转换成url参数
 *
 * @param $url链接地址
 * @param $data请求数组
 *
 * @return string
 */
function makeUrlData($url, $data)
{
    $rescult = http_build_query($data);
    return $url . "?" . $rescult;

}

/**根据生日计算年龄
 * @param $birthday ['生日的时间戳:阳历']
 * return 年龄正整数
 */
function clalculateAgeByBirthday($birthday)
{
    return floor((strtotime(date('Y-m-d'))-$birthday)/3600/24/365);
}




