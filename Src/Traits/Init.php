<?php
namespace Src\Traits;
// use Src\Interfaces\Search as InterfacesSearch;
use Src\Grammar;
trait Init {
    public Grammar $sqlGrammar;
    // default DB table name
    private $table ;
    private $primaryKey = 'id';
    // default columns in DB table
    private array $columns;
    public function __init()
    {
        $this->select = false;
        // new for syntax builder
        $this->sqlGrammar = new Grammar();
    }
    // select table if empty will build 
    // syntax to select all
    public function table(string $table)
    {
        $this->table = $table;
        return $this;
    }
    private function startSql(){
        if($this->sqlGrammar->getWord() == ''){
            if(!empty($this->columns))
            {
                $this->sqlGrammar->select()->arrayBetweenSub($this->columns)->from();
            }
            else
            {
                $this->sqlGrammar->selectAll();
            }
        }
        $this->sqlGrammar->add($this->table);

        return $this;
    }
    public function setColumns(array $columns)
    {
        $this->columns = $columns;
    }
    public function setTable(string $table)
    {
        $this->columns = $table;
    }
    
    
}