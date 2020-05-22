<?php
try{
    $DB = new PDO('mysql:host=localhost; dbname=calendar', 'root', '', array(PDO::MYSQL_ATTR_INIT_COMMAND => 'SET NAMES UTF8'));
}
catch (PDOException $e) {
    echo 'Error Database !!';
    exit();
}