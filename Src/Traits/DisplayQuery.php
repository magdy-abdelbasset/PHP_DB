<?php
namespace Src\Traits;
// use Src\Interfaces\Search as InterfacesSearch;
use Src\Utils\Helper;
trait DisplayQuery {
    use Helper;
    protected $firstOrderBy =true;
    protected $firstGroupBy =true;
    public function orderBy($column,$type = 'ASC')
    {
        if($this->firstOrderBy){
            $this->firstOrderBy = false;
            $this->sqlGrammar->orderBy()->add($column)->add($type,' ');
        }else{
            $this->sqlGrammar->add(',',' ')->add($column)->add($type,' ');
        }
        return $this;
    }
    public function groupBy(string $column)
    {
        if($this->firstGroupBy){
            $this->firstGroupBy = false;
            $this->sqlGrammar->groupBy()->add($column);
        }else{
            $this->sqlGrammar->add(',',' ')->add($column);
        }
        return $this;
    }
}