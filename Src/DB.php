<?php
namespace Src;
use Src\Traits\CSRF;
use Src\Traits\Search;
use Src\Traits\Display;
use Src\Interfaces\DB as DBInterface;
use Src\Traits\DisplayQuery;
use Src\Traits\Init;
use Src\Traits\Relationship;

class DB extends Query  implements DBInterface{
    use CSRF ,Search ,Display,Init,DisplayQuery,Relationship;

    public function __construct()
    {

        $this->__init();
    }
     // fake "extends C" using magic function

} 