<?php
include_once "config.php";
$id=$_GET['id'];
$query = "DELETE FROM Weather WHERE ID=? ";
$q = $connection->prepare($query);
$result = $q->execute([$id]);
if($result){
    header("Location: index.php");
}else{
    header("Location: index.php?res=failed");
}