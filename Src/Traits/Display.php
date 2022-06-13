<?php
namespace Src\Traits;

use Exception;

// use Src\Interfaces\Display as InterfacesDisplay;
trait Display {
    
    public function all(): array
    {
        $this->sqlGrammar->selectAll();
        return $this->run();
    }
    public function get(): array
    {
        $this->startSql();
        return $this->run();

    }
    public function first(): array
    {
        $this->startSql();
        return $this->run()[0];   
    }
    public function find($value ,bool $error_more_one = true): array
    {
        $this->where($this->primaryKey,$value);
        $data = $this->run();
        if(count($data) > 1 && $error_more_one){
            throw new Exception("NOT PRIMARY KEY >>>> the data result more then one row");
        }
        return $data[0];   
    }

}