<?php

require_once 'function.php';

$result_name = queryMysql("SELECT `user_name` FROM profiles WHERE user='$user'");

if ($result_name->num_rows) {
    $row1 = $result_name->fetch_array(MYSQLI_ASSOC);
    /*echo stripslashes($row1['user_name']);*/
}

$result_secondName = queryMysql("SELECT `user_secondName` FROM profiles WHERE user='$user'");

if ($result_secondName->num_rows) {
    $row = $result_secondName->fetch_array(MYSQLI_ASSOC);
    /*echo stripslashes($row['user_secondName']);*/
}