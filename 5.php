<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN">
<html>
  <head>
  <meta http-equiv="content-type" content="text/html; charset=utf-8">
  <meta name="generator" content="PSPad editor, www.pspad.com">
  <title></title>
 
<!--
Styl oddělený
-->
<style>
table {
    width: 100%;
    border-collapse: collapse;
}

table, td, th {
    border: 1px solid black;
    padding: 2px;
}

th {text-align: left;}
</style>
</head>
<body>

<?php
header('Content-Type: text/html; charset=utf-8');
 require("../CONNECT/CONNECT.php"); 
  $databaze=new mysqli($host, $user, $password, $db) or die("connect ERROR");
  $databaze->set_charset("utf8");
  if ($databaze->connect_errno){
  printf("Pripojeni spadlo: %s\n", $databaze->connect_error);
       exit();
            }
mysqli_select_db($databaze,"Ulovek");
$q=$_SESSION['id'];
$sql="SELECT * FROM Ulovek WHERE Uzivatel_idUzivatel = '".$q."'";
$sql2="SELECT Druh.nazev FROM Druh, Ulovek WHERE Ulovek.Druh_idDruh = Druh.idDruh";
$sql3="SELECT Revir.nazev FROM Revir, Ulovek WHERE Ulovek.Revir_idRevir = Revir.idRevir";
$result = mysqli_query($databaze,$sql);
$result2 = mysqli_query($databaze,$sql2);
$result3 = mysqli_query($databaze,$sql3);  
echo "<table class=\"table table-bordered\">";
echo " <thead>";
echo "<tr>";
echo "<th>Rozměr</th>";
echo "<th>Váha</th>";
echo "<th>Datum</th>";
echo "<th>Způsob lovu</th>";
echo "<th>Ryba</th>";
echo "<th>Revír</th>";
echo "</tr>";
echo "   </thead>";
while($row = mysqli_fetch_array($result)) {
     echo "<tr>";
    echo "<td>" . $row['rozmer'] . "</td>";
    echo "<td>" . $row['vaha'] . "</td>";
    echo "<td>" . $row['datum'] . "</td>";
     echo "<td>" . $row['zpusob_lovu'] . "</td>";
    $row = mysqli_fetch_array($result2); 
             echo "<td>" . $row['nazev']. "</td>";
             
     $row = mysqli_fetch_array($result3); 
             echo "<td>" . $row['nazev']. "</td>";          
     
    echo "</tr>";
}
echo "</table>";
mysqli_close($databaze);


?>
</body>
</html>