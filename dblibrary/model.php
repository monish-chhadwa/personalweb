<?php
/**
 * Created by PhpStorm.
 * User: monish.c
 * Date: 8/5/2015
 * Time: 3:11 PM
 */
abstract class dbmodel{
    abstract public static function connect($host,$username,$passwd,$dbname,$port,$socket);
    abstract public function find($params = array(),$cols='first');
}

class mysqlC extends dbmodel{
    private static $connectionObj;
    private static $instance;
    public static function connect($host,$username,$passwd,$dbname,$port,$socket){
        mysqlC::$connectionObj = new mysqli($host,$username,$passwd,$dbname,$port,$socket);
        mysqlC::$instance=new mysqlC();
        return mysqlC::$instance;
    }
    public function find($params = array(),$cols='first'){
        if($cols=='first') {
            $query = "SELECT " . implode(',', $params['cols']) . " FROM `" . $params['table'] . "` LIMIT 1";
        }
        elseif($cols=='count'){
            $query = "SELECT COUNT(*) FROM `".$params['table']."`";
        }
        $result = mysqlC::$connectionObj->query($query);
        if (!$result) return "Query execution failed!";
        else return $result->fetch_assoc();
    }
}

class mssqlC extends dbmodel{
    private static $connectionObj;
    private static $instance;
    public static function connect($host,$username,$passwd,$dbname,$port,$socket){
        mssqlC::$connectionObj = new PDO('sqlsrv:Server='.$host.','.$port.';Database='.$dbname, $username,  $passwd);
        mssqlC::$instance=new mssqlC();
        return mssqlC::$instance;
    }
    public function find($params = array(),$cols='first'){
        if($cols=='first') {
            $query = "SELECT " . implode(',', $params['cols']) . " FROM `" . $params['table'] . "` LIMIT 1";
        }
        elseif($cols=='count'){
            $query = "SELECT COUNT(*) FROM `".$params['table']."`";
        }
        $result = mssqlC::$connectionObj->query($query);
        if (!$result) return "Query execution failed!";
        else return $result->fetch_assoc();
    }
}

class dbLibrary{    //This is our factory class!

    //public $dbsystem;
    //public $host,$username,$passwd,$dbname,$port,$socket;

    //Implementing singleton
    private static $onlyInstance=null;
    private function __construct(){}
    public static function getDbInstance($dbsystem='mysql',$host=null,$username=null,$passwd=null,$dbname=null,$port=null,$socket=null){
        if(dbLibrary::$onlyInstance==null) {
            dbLibrary::$onlyInstance = new dbLibrary();
            //dbLibrary::$onlyInstance->dbsystem = $dbsystem;
            /*dbLibrary::$onlyInstance->*/$host = isset($host) ? $host : ini_get("mysqli.default_host");
            /*dbLibrary::$onlyInstance->*/$username = isset($username) ? $username : ini_get("mysqli.default_user");
            /*dbLibrary::$onlyInstance->*/$passwd = isset($passwd) ? $port : ini_get("mysqli.default_pw");
            /*dbLibrary::$onlyInstance->*/$dbname = isset($dbname) ? $dbname : '';
            /*dbLibrary::$onlyInstance->*/$port = isset($port) ? $port : ini_get("mysqli.default_port");
            /*dbLibrary::$onlyInstance->*/$socket = isset($socket) ? $socket : ini_get("mysqli.default_socket");
            if($dbsystem=="mysql"){
                dbLibrary::$onlyInstance=mysqlC::connect($host,$username,$passwd,$dbname,$port,$socket);
            }
            elseif($dbsystem=="mssql"){
                dbLibrary::$onlyInstance=mssqlC::connect($host,$username,$passwd,$dbname,$port,$socket);
            }
        }
        return dbLibrary::$onlyInstance;
    }
    //Singleton implementation ends
}