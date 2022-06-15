<?php
namespace Src\Traits;

use Src\Interfaces\CSRF as InterfacesCSRF;
use Src\Connect;
trait CSRF {
    use Init;
    protected $lastSql;
    public function insert(array $columnsValues,$values=null)
    {
        // set insert sql syn
        $this->addTable();
        $this->sqlGrammar->insert(true);
        $this->statement($columnsValues);
        return $this;
    }
    public function delete()
    {
        $this->lastSql = $this->sqlGrammar->getWord();
        $this->sqlGrammar->setWord('');
        $this->addTable();
        $this->sqlGrammar->delete(true);
        $this->statement([],2);
        return $this; 
    }
    public function update(array $columnsValues ,$values=null)
    {
        $this->lastSql = $this->sqlGrammar->getWord();
        $this->sqlGrammar->setWord('');
        $this->sqlGrammar->set(true);
        $this->addTable();
        $this->sqlGrammar->update(true);
        $this->statement($columnsValues,1);
        return $this; 
    }
    public function select(array $columns)
    {
        $this->selectColumns =$columns ;
        return $this;
        // $this->sqlGrammar = $this->sqlGrammar->select()->arrayBetweenSub($columns);
    }
    
}