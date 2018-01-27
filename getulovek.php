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

require_once "../CONNECT/CONNECT.php";

mysqli_select_db($databaze,"Ulovek");
$sql="SELECT * FROM Ulovek WHERE Uzivatel_idUzivatel = '".$q."'";
$result = mysqli_query($databaze,$sql);

echo "<table class=\"table table-bordered\">";
echo " <thead>";
echo "<tr>";
echo "<th>Rozměr</th>";
echo "<th>Váha</th>";
echo "<th>Datum</th>";
echo "<th>Způsob lovu</th>";
echo "<th>Revír</th>";
echo "<th>Druh</th>";
echo "</tr>";
echo "   </thead>";
while($row = mysqli_fetch_array($result)) {
     echo "<tr>";
    echo "<td>" . $row['rozmer'] . "</td>";
    echo "<td>" . $row['vaha'] . "</td>";
    echo "<td>" . $row['datum'] . "</td>";
    echo "</tr>";
}
echo "</table>";
mysqli_close($databaze);
?>
</body>
</html>