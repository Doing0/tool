# password使用说明(Tp5)

- 加密
```
 public function inedx()
    {
        $password = '123456';
        $hash_passworde =  \Lib\Password::hash($password);
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
         $res =  \Lib\Password::verify($password,$hash_passworde);
        //如果匹配$res= true 否是=false
     }//pf
 ```