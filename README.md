# password使用说明(Tp5)

- 加密
```
 use Doing\password\Password;
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