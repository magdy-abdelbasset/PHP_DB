<?php
namespace Src;

use PDO;

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
        public function run($sql_word=null)
        {
            $sql_word = $sql_word ?? $this->sqlGrammar->getWord();
            if(parent::type() == 'pdo')
            {
                $statement =  parent::getConnect()->query($sql_word,PDO::FETCH_ASSOC);
                return $statement->fetchAll(PDO::FETCH_ASSOC);
;
            }
            # code...
        }
} 