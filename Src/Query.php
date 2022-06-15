<?php

namespace Src;

use PDO;
use PDOException;

class Query  extends Connect
{

    // $sql = 'SELECT name, color, calories FROM fruit ORDER BY name';
    // foreach ($conn->query($sql) as $row) {
    //     print $row['name'] . "\t";
    //     print $row['color'] . "\t";
    //     print $row['calories'] . "\n";
    // }
    // $res = $db->query('SELECT * FROM `mytable` WHERE true', PDO::FETCH_ASSOC);

    // fake "extends C" using magic function
    //  PDO::exec() - Execute an SQL statement and return the number of affected rows
    // PDO::prepare() - Prepares a statement for execution and returns a statement object
    // PDOStatement::execute() - Executes a prepared statement
    public function run($sql = null)
    {
        try {
            if (!parent::getConnect()) {
                parent::init();
            }
            if ($sql) {
                $this->sqlGrammar->add($sql, '', '');
            }
            if (parent::type() == 'pdo') {
                $statement =  parent::getConnect()->query($this->sqlGrammar->getWord(), PDO::FETCH_ASSOC);
                return $statement->fetchAll(PDO::FETCH_ASSOC);
            }
            parent::closeConnection();
        } catch (\PDOException $e) {
            throw new PDOException("ERROR PDO MESSAGE :" . $e . "</br> 
                YOUR SQL IS  >>>>>  " . $this->sqlGrammar->getWord());
        }
    }
    protected function statement(array $fields,int $type =0)
    {

        try {
            if (!parent::getConnect()) {
                parent::init();
            }
            $sql_word = $sql_word ?? $this->sqlGrammar->getWord();
            if (Connect::type() == 'pdo') {
                if($type==0){
                    $this->sqlGrammar->arrayConnectDuplicateKeys(array: $fields);
                }elseif($type==1){
                    
                    $this->sqlGrammar->arrayDuplicateKeys($fields)->add($this->lastSql,'');
                }elseif($type ==2){
                    $this->sqlGrammar->add($this->lastSql,'');
                }
                $stmt = parent::getConnect()->prepare($this->sqlGrammar->getWord());
                foreach ($fields as $Name => &$Value) {
                    $stmt->bindParam(':' . $Name, $Value, PDO::PARAM_STR);
                }
                $stmt->execute();
            }
        } catch (\PDOException $e) {
            throw new PDOException("ERROR PDO MESSAGE :" . $e . "</br> 
            YOUR SQL IS  >>>>>  " . $this->sqlGrammar->getWord());
        }
        parent::closeConnection();
    }
}
