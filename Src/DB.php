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
        $word = $grammar->arrayConnect($array);
        return $word;
    }
} 