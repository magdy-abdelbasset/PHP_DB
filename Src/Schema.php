<?php

namespace Src;

class Schema extends Query {

    public function tableExist($table)
    {
        $db = DB_NAME;
        $sql = "SELECT COUNT(*) 
                 FROM information_schema.TABLES 
                 WHERE TABLE_SCHEMA = '$db' 
                 AND  TABLE_NAME = '$table'";
        $rows = $this->run();
        return $rows > 0;
    }
}
