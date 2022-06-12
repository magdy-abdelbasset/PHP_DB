<?php
namespace Src;
use Src\Traits\CSRF;
use Src\Traits\Search;
use Src\Traits\Display;
use Src\Interfaces\DB as DBInterface;
use Src\Traits\Init;

class DB extends Query  implements DBInterface{
    use CSRF ,Search ,Display,Init;

    public function __construct()
    {
        if(!parent::getConnect()){
            parent::init();   
        }
        $this->__init();
    }
     // fake "extends C" using magic function

} 