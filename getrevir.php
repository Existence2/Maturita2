
<!DOCTYPE html>
<html>
<head>
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

mysqli_select_db($databaze,"Revir");

$sql="SELECT * FROM Revir WHERE nazev = '".$q."'";
$result = mysqli_query($databaze,$sql);

echo "<table class=\"table table-bordered\">
 <thead>
<tr>
<th>název</th>
<th>kraj</th>
<th>popis</th>
<th>velikost</th>
<th>svaz</th>

</tr>
   </thead>";
while($row = mysqli_fetch_array($result)) {
     echo "<tr>";
    echo "<td>" . $row['nazev'] . "</td>";
    echo "<td>" . $row['kraj'] . "</td>";
    echo "<td>" . $row['popis'] . "</td>";
    echo "<td>" . $row['velikost'] . "</td>";
    echo "<td>" . $row['svaz'] . "</td>";

    echo "</tr>";
}
echo "</table>";
mysqli_close($databaze);
?>
</body>
</html>