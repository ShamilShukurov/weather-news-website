<?php
try{
    $connection= new PDO("mysql:dbname=shamil002_weather;host=mysql-shamil002.alwaysdata.net","shamil002","oasis345!");
    $connection->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_WARNING);
}catch(PDOException $e){
    exit('Error: '.$e->getMessage());
}
