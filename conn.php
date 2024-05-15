<?php

try{
    $pdo = new PDO('mysql:host=localhost;dbname=3590879_inventory','root','');
    //echo 'Connection Successfull';
}catch(PDOException $error){
    echo $error->getmessage();
}


?>