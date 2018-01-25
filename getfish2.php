
<!DOCTYPE html>
<html>
<head>
<meta charset="utf-8">
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

$q = $_GET['q'];

 require("../CONNECT/CONNECT.php"); 
  $databaze=new mysqli($host, $user, $password, $db) or die("connect ERROR");
  $databaze->set_charset("utf8");
  if ($databaze->connect_errno){
  printf("Pripojeni spadlo: %s\n", $databaze->connect_error);
       exit();
            }

mysqli_select_db($databaze,"Druh");
//$sql="SELECT last_name, first_name, state FROM president WHERE state = '".$q."'";
$sql="SELECT * FROM Druh WHERE nazev = '".$q."'";
$result = mysqli_query($databaze,$sql);

echo "<table class=\"table table-bordered\">
 <thead>
<tr>
<th>název</th>
<th>rad</th>
<th>celed</th>
<th>zacatek_hajeni</th>
<th>konec_hajeni</th>
<th>potrava</th>
<th>navnada</th>
<th>popis</th>
</tr>;
   </thead>";
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