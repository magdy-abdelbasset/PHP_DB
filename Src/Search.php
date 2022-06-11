<?php
namespace Src;

use Src\Interfaces\Search as InterfacesSearch;

class Search implements InterfacesSearch{
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