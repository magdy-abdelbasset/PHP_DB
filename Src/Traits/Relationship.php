<?php
namespace Src\Traits;
// use Src\Interfaces\Search as InterfacesSearch;
use Src\Utils\Helper;
trait Relationship {
    use Helper;

    public function join(string $table,$condition)
    {
        $this->sqlGrammar->join()->add($table)->on()->add($condition ,'');
        return $this;
    }
    public function leftJoin(string $table,$condition)
    {
        $this->sqlGrammar->leftJoin()->add($table)->on()->add($condition,'');
        return $this;
    }
    public function rightJoin(string $table,$condition)
    {
        $this->sqlGrammar->rightJoin()->add($table)->on()->add($condition,'');
        return $this;
    }
    public function fullJoin(string $table,$condition)
    {
        $this->sqlGrammar->fullJoin()->add($table)->on()->add($condition,'');
        return $this;
    }
}