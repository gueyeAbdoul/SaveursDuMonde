<?php

namespace pdo_config;

use \PDO ;

class PdoConfig
{

    private $db_name ;
    private $db_user ;
    private $db_pwd ;
    private $db_host ;
    private $db_port ;
    public $pdo ;

    public function __construct($db_name, $db_host='localhost', $db_port='3306', $db_user = 'root', $db_pwd=''){
        $this->db_name = $db_name ;
        $this->db_host = $db_host ;
        $this->db_port = $db_port ;
        $this->db_user = $db_user ;
        $this->db_pwd = $db_pwd ;

        //$dsn = 'postgreSQL:dbname=' . $this->db_name . ';host='. $this->db_host. ';port=' . $this->db_port;
        
       // $dsn = 'pgsql:dbname=' . $this->db_name . ';host=' . $this->db_host . ';port=' . $this->db_port;

        // Code nouveau
        // Correction du DSN pour MySQL avec WAMP
        $dsn = "mysql:host=" . $this->db_host . ";dbname=" . $this->db_name . ";charset=utf8";
        
        // Configuration des options PDO
        $options = [
            PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
            PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
            PDO::ATTR_EMULATE_PREPARES => false,
        ];
        

        try{
            $this->pdo = new PDO($dsn, $this->db_user, $this->db_pwd);
        }catch (\Exception $ex){
            die('Error : ' . $ex->getMessage()) ;
        }

    }

    public function exec($statement, $params, $classname=null){
        $res = $this->pdo->prepare($statement) ;
        $res->execute($params) or die(print_r($res->errorInfo()));

        if($classname != null){
            $data = $res->fetchAll(PDO::FETCH_CLASS, $classname);
        }else{
            $data = $res->fetchAll(PDO::FETCH_ASSOC); // Utilisation de FETCH_ASSOC
        }

        return $data ;
    }

    public function exec1($statement, $params, $classname = null) {
        $res = $this->pdo->prepare($statement);
        foreach ($params as $key => $value) {
            // Si la valeur est un tableau, convertissez-la en une chaîne séparée par des virgules
            if (is_array($value)) {
                $params[$key] = implode(',', $value);
            }
        }
        $res->execute($params) or die(print_r($res->errorInfo()));

        if ($classname != null) {
            $data = $res->fetchAll(PDO::FETCH_CLASS, $classname);
        } else {
            $data = $res->fetchAll(PDO::FETCH_ASSOC);
        }

        return $data;
    }



}