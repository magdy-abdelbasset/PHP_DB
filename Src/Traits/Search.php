<?php
namespace Src\Traits;
// use Src\Interfaces\Search as InterfacesSearch;
use Src\Utils\Helper;
trait Search {
    private string $column ;
    private  $operator ;
    private $value ;
    private $whereSyntax;
    protected $firstWhere = true;
    use Helper;

    public function where(string $column,$operator='=' ,$value=null)
    {

        $this->middleNotRequire('=',$operator,$value);
        $this->column = $column;
        $this->operator = $operator;
        $this->value = $value;
        // $this->startSql();
        $this->runWhere('and');

        return $this;


    }
    public function whereIn(string $column,array $values)
    {
        foreach($values as $value){
            $this->orWhere($column,$value);
        }
        return $this;
    }
    public function orWhere(string $column,$operator="=",$value=null)
    {
        $this->middleNotRequire('=',$operator,$value);
        $this->column = $column;
        $this->operator = $operator;
        $this->value = $value;
        // $this->startSql();
        $this->runWhere('or');
    }
    public function whereNotIn(string $column ,array $values)
    {
        
    }
    private function runWhere($op = 'and')
    {
        if(!$this->firstWhere ){
            $this->firstWhere = false;
            $this->sqlGrammar->where()->add($this->column)->add($this->operator.' ','')->add($this->value,'"');
        }else{
            
            $this->sqlGrammar->$op()->add($this->column)->add($this->operator.' ','')->add($this->value,'"');
        };
    }
}