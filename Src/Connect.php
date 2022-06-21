<?php

namespace Src;
use Exception;

class Connect
{
    // currently connection
    private static $connect;
    // 
    private static  string $connect_type;
    // query sql
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
        throw new Exception("can't create new object from Connect class");
    }
    public  function init(string $connect_type = DB_CONNECT,string $host = DB_HOST . ':' . DB_PORT, string $password = DB_PASSWORD, string $username = DB_USER, string $dbname = DB_NAME)
    // (string $connect_type = 'pdo',string $host = '127.0.0.1:3306' , string $password = '', string $username = 'root', string $dbname = 'gy')
    {
        // string $connect_type = DB_CONNECT,string $host = DB_HOST . ':' . DB_PORT, string $password = DB_PASSWORD, string $username = DB_USER, string $dbname = DB_NAME
        
        if(!in_array($connect_type,CONNECT_TYPE)){
            throw new Exception("nam type connect is't correct");
        }
        self::$connect_type = $connect_type;
        try {
            // when connection success save in virables
            self::$host = $host ;
            self::$dbname = $dbname;
            self::$username = $username;
            self::$password = $password;
            self::connect();
        } catch (\PDOException  $e) {
            
            // print in terminal
            throw new Exception("Connection Failed >>> \n error message >>> " . $e->getMessage());
        }
    }
    public  function getConnect()
    {
        return self::$connect;
    }
    private  function Connect()
    {
        if(self::$connect){
            self::closeConnection();
        }
        switch (self::$connect_type) {
            case 'pdo':
                    self::$connect = new \PDO('mysql:host=' . self::$host . ';dbname=' . self::$dbname, self::$username, self::$password);           
                 break;
            default:
                throw new Exception("sorry ,we support pdo only");
                exit;
        }
    }
    protected  function closeConnection()
    {
        switch (self::$connect_type) {
            case 'pdo':
                self::$connect = null;
                break;
            default:
                throw new Exception("sorry ,we support pdo only");
                exit;
        }
    }
    public function type(){
        return self::$connect_type;
    }

}
