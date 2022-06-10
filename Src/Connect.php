<?php

namespace Src;

class Connect
{
    // currently connection
    private static  $connect;
    // 
    private static string $connect_type;
    // query sql
    private static string $sql;
    // save host and connect type  
    // will use when change dbname
    private static string $host;
    // example 'mysql:host=localhost;dbname='
    // currently dbname which connect with it
    private static string $dbname;
    private static string $username;
    private static string $password;
    public  function  __construct()
    {
        throw "can't create new object from Connect class";
    }
    public static function setConnection(string $connect_type = DB_CONNECT,string $host = DB_HOST . ':' . DB_PORT, string $password = DB_PASSWORD, string $username = DB_USER, string $dbname = DB_NAME)
    {
        self::$connect_type = $connect_type;
        try {
            // when connection success save in virables
            self::$host = $connect_type . ':host=' . $host . ';dbname=';
            self::$dbname = $dbname;
            self::$username = $username;
            self::$password = $password;
            self::connect();
        } catch (\PDOException  $e) {
            // print in terminal
            throw "Connection Failed >>> \n error message >>> " . $e->getMessage();
        }
    }
    public static function getConnect()
    {
        return self::$connect;
    }
    private static function Connect()
    {
        if(self::$connect){
            self::closeConnection();
        }
        switch (self::$connect_type) {
            case 'pdo':
                    self::$connect = new \PDO('mysql:host=' . self::$host . ';dbname=' . self::$dbname, self::$username, self::$password);
                break;
            default:
                throw "sorry ,we support pdo only";
                exit;
        }
    }
    private static function closeConnection()
    {
        switch (self::$connect_type) {
            case 'pdo':
                self::$connect = null;
                break;
            default:
                throw "sorry ,we support pdo only";
                exit;
        }
    }

}
