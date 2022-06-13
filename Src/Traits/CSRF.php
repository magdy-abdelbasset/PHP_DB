<?php
namespace Src\Traits;

use Src\Interfaces\CSRF as InterfacesCSRF;
use Src\Connect;
trait CSRF {
    use Init;
    public $select = false;
    public function insert(array $columnsValues,$values=null)
    {
        $this->sqlGrammar->insert();
        $this->startSql();
        $this->statement($columnsValues);
        return $this;
    }
    public function delete()
    {
        $this->sqlGrammar->insert();
        $this->startSql();
        $this->sqlGrammar = $this->sqlGrammar->delete();   
    }
    public function update(array $values)
    {
        $this->sqlGrammar->insert();
        $this->startSql();
        $this->sqlGrammar = $this->sqlGrammar ; 
    }
    public function select(array $columns)
    {
        $select = true ;
        // $this->sqlGrammar = $this->sqlGrammar->select()->arrayBetweenSub($columns);
    }
    
}