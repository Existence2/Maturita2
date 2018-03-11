<?php

 
    require_once "../CONNECT/CONNECT.php";
    $databaze=new mysqli($host, $user, $password, $db) or die("connect ERROR");
    $databaze->set_charset("utf8");
     if ($databaze->connect_errno){
            printf("Pripojeni spadlo: %s\n", $databaze->connect_error);
            exit();
          }

?>
