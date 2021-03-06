<?php

/*use util\MySQL;
use model\Entity\DatabaseConnection;*/

$dbhost  = 'localhost';    // Unlikely to require changing
$dbname  = 'robinsnest';   // Modify these...
$dbuser  = 'robinsnest';   // ...variables according
$dbpass  = 'asutpdp3';   // ...to your installation
$appname = "SocSet"; // ...and preference

$connection = new mysqli($dbhost, $dbuser, $dbpass, $dbname);
if ($connection->connect_error) die($connection->connect_error);
/*
//Создаем объект для подключения к БД
$connection = new DatabaseConnection(
    'localhost',
    'robinsnest',
    'robinsnest',
    'asutpdp3',
    'mysql'
);

try{
    //Соединямся с БД
    MySQL::$db = new \PDO(
        $connection->GetConnectionString() ,
        $connection->user,
        $connection->password,
        array( \PDO::MYSQL_ATTR_INIT_COMMAND => 'SET NAMES \'UTF8\'' )
    );

}//try
catch(\PDOException $ex){

    echo $ex->getMessage();
    exit();

}//catch*/

function createTable($name, $query)
{
    queryMysql("CREATE TABLE IF NOT EXISTS $name($query)");
    echo "Table '$name' created or already exists.<br>";
}

function queryMysql($query)
{
    global $connection;
    $result = $connection->query($query);
    if (!$result) die($connection->error);
    return $result;
}

function destroySession()
{

    $_SESSION=array();

    if (session_id() != "" || isset($_COOKIE[session_name()]))
        setcookie(session_name(), '', time()-2592000, '/');

    session_destroy();

}

function sanitizeString($var)
{
    global $connection;
    $var = strip_tags($var);
    $var = htmlentities($var);
    $var = stripslashes($var);
    return $connection->real_escape_string($var);
}



function showProfile($user)
{
    if (file_exists("$user.jpg"))
        echo "<img src='$user.jpg' style='float:left;'>";

    $result = queryMysql("SELECT * FROM profiles WHERE user='$user'");

    if ($result->num_rows)
    {
        $row = $result->fetch_array(MYSQLI_ASSOC);
        echo stripslashes($row['text']) . "<br style='clear:left;'><br>";
        echo stripslashes($row['user_name']) . "<br style='clear:left;'><br>";
        echo stripslashes($row['user_secondName']) . "<br style='clear:left;'><br>";
    }
}
?>
