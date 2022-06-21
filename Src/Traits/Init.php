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
    private  $columns=null;
    private $selectColumns=null;
    private $keysNotBetween=null;
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
    private function addTable(){
        // if($this->sqlGrammar->getWord() == ''){
            // add before sql syntax
            $this->sqlGrammar->add($this->table,before:true);
            // if(!empty($this->columns))
            // {
            //     // add before sql syntax
            //     $this->sqlGrammar->arrayBetweenSub($this->columns);
            // }
            // else
            // {
                // add before sql syntax
            //  $this ->sqlGrammar ->add(" * ", )
                // $this->sqlGrammar->selectAll(true);
            // }
        // }
        

        return $this;
    }
    private function addColumns($between='`'){
            // add before sql syntax
            if(!empty($this->columns) || !empty($this->selectColumns))
            {
                if(!empty($this->selectColumns)){
                    $this->sqlGrammar->arrayBetweenSub($this->selectColumns,'','',before:true);
                }else{

                // add before sql syntax
                    $this->sqlGrammar->arrayBetweenSub($this->columns,$between,$between,before:true);
                }
            }
            else
            {
                // add before sql syntax
                $this ->sqlGrammar ->add(" * ",'',before:true );
                // $this->sqlGrammar->selectAll(true);
            }
        // }
        

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