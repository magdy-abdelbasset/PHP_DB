<?php
namespace Src\Traits;

use Src\Interfaces\CSRF as InterfacesCSRF;

trait CSRF {
    use Init;
    public $select = false;
    public function insert(array $columns, ?array $values)
    {
        $this->sql = $this->sql->insert()->arr;
    }
    public function delete()
    {
        $this->sqlGrammar = $this->sqlGrammar->delete();   
    }
    public function update(array $values)
    {
        $this->sqlGrammar = $this->sqlGrammar ; 
    }
    public function select(array $columns)
    {
        $select = true ;
        // $this->sqlGrammar = $this->sqlGrammar->select()->arrayBetweenSub($columns);
    }
    
}