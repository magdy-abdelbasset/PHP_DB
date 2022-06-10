<?php
// define connection details and
// error log and development or production 
namespace Src;

use Src\Grammar;

class DB {
    
    public function insert()
    {
        $grammar = new Grammar();
        $array = [
            'user'=>"magdy",
            "email"=>"magdy@m.com",
            "password"=>123456
        ];
        $array2 = [
            "magdy",
            "magdy@m.com",
            123456
        ];
        $keys = [
            'user',
            "email",
            "password"
        ];
        
        $word = $grammar->setWord('')->arrayConnectMulti($keys,$array2)->getWord();
        return $word;
    }

} 