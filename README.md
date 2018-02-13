#常用工具
##  password使用说明(Tp5)

- 加密
```
 use Doing\tool\Password;
 public function inedx()
    {
        $password = '123456';
        $hash_passworde =  Password::hash($password);
        echo "加密后的密码:".$hash_passworde;
    }//pf
 ```
 
 - 密码校验
 ```
  public function verify()
     {
        //原始密码
        $password = '123456';
        //加密后密码
        $hash_passworde = '$2y$12$URUM8UrIhaGpHoQDw34dJ.kjRF9Opv.tK/1Rb9GzFWudHYzfNDFla';
        $res =  Password::verify($password,$hash_passworde);
        print_r($res);
        //如果匹配$res= true 否是=false
     }//pf
 ```
 ##  functions.php常用算法方法
 ```
 1.$randStr = getRandChar($length=32);获取指定长度的随机字符串
 2.$newArray = array2DSortByField($array,'number','desc');按number字段倒序
    print_r($newArray);
    array(2) {
      [0] => array(1) {
        ["number"] => int(50)
      }
      [1] => array(1) {
        ["number"] => int(2)
      }
    }
 3.$km = getDistanceByCoordinate($myY, $myX, $targetY, $targetX)
   //根据两个经纬度计算出距离(单位KM)
   print_r($km);
 4. $RgbArray = hexToRGB("#FF0000");//16进制颜色转换成rgb
     array(3) {
       ["red"] => int(255)
       ["green"] => int(0)
       ["blue"] => int(0)
     }
    
```
 