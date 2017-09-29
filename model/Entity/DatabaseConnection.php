<?php

namespace model\Entity;

class DatabaseConnection
{

    private $host;
    private $database;
    private $user;
    private $password;
    private $driver;

    function __construct($host, $database, $user, $password, $driver)
    {

        $this->password = $password;
        $this->driver = $driver;
        $this->host = $host;
        $this->user = $user;
        $this->database = $database;

    }//

    function __get($name)
    {
        return $this->$name;
    }//__get

    function __set($name, $value)
    {
        $this->$name = $value;
    }//__set

    function GetConnectionString()
    {
        return "{$this->driver}:dbname={$this->database};host{$this->host}";
    }//GetConnectionString

}