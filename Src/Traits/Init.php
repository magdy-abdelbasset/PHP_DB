<?php
namespace Src\Traits;
// use Src\Interfaces\Search as InterfacesSearch;
use Src\Grammar;
trait Init {
    public Grammar $sqlGrammar;
    private $table ;
    public function __init()
    {
        $this->select = false;
        $this->sqlGrammar = new Grammar();

    }
    public function table(string $table)
    {
        $table = "`$table`";
        if($this->sqlGrammar->getWord() == ''){
            $this->sqlGrammar->selectAll();
        }
        $this->sqlGrammar->add($table);
        return $this;
    }
    
    
}