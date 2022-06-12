<?php
namespace Src\Traits;
// use Src\Interfaces\Search as InterfacesSearch;

trait Search {
    public function where(string $column,$orator="=" ,$value)
    {
        
    }
    public function whereIn($column,array $valuess)
    {
        
    }
    public function orWhere(string $column,$orator="=",$value)
    {
        
    }
    public function whereNotIn(string $column ,array $values)
    {
        
    }
}