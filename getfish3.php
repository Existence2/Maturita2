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

$q = $_GET['q'];

 require("../CONNECT/CONNECT.php"); 
  $databaze=new mysqli($host, $user, $password, $db) or die("connect ERROR");
  $databaze->set_charset("utf8");
  if ($databaze->connect_errno){
  printf("Pripojeni spadlo: %s\n", $databaze->connect_error);
       exit();
            }

mysqli_select_db($databaze,"Druh");
$sql="SELECT * FROM Druh WHERE nazev = '".$q."'";
$result = mysqli_query($databaze,$sql);

echo "<table class=\"table table-bordered\">";
echo " <thead>";
echo "<tr>";
echo "<th>název</th>";
echo "<th>řád</th>";
echo "<th>čeleď</th>";
echo "<th>začátek hájení</th>";
echo "<th>konec hájení</th>";
echo "<th>potrava</th>";
echo "<th>návnada</th>";
echo "<th>popis</th>";
echo "</tr>";
echo "   </thead>";
while($row = mysqli_fetch_array($result)) {
     echo "<tr>";
    echo "<td>" . $row['nazev'] . "</td>";
    echo "<td>" . $row['rad'] . "</td>";
    echo "<td>" . $row['celed'] . "</td>";
    echo "<td>" . $row['zacatek_hajeni'] . "</td>";
    echo "<td>" . $row['konec_hajeni'] . "</td>";
    echo "<td>" . $row['potrava'] . "</td>";
    echo "<td>" . $row['navnada'] . "</td>";
    echo "<td>" . $row['popis'] . "</td>";
    echo "</tr>";
}
echo "</table>";
mysqli_close($databaze);
?>
</body>
</html>