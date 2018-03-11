
<?


$q=$_SESSION['id'];

if (isset($_REQUEST["id"]))
{
  include("14.php");
  exit;
  
}
else
{


echo "<table class=\"table table-bordered\">";
echo " <thead>";
echo "<tr>";
  echo "<th>Nadpis</th>";
  echo "<th>Uživatel</th>";
  echo "<th>Datum</th>";
echo "</tr>";
echo "   </thead>";

require_once("MySQL.php"); 
$prikaz = "SELECT Clanek.idClanek as id, Uzivatel.jmeno as jmeno, Clanek.nazev as nazev, Clanek.datum as datum FROM Clanek INNER JOIN Uzivatel WHERE Clanek.Uzivatel_idUzivatel = Uzivatel.idUzivatel  ";
$tabulka = $databaze->query($prikaz); 
while($row=$tabulka->fetch_object()) {
 
    echo "<tr>";
    echo "<td>";
     echo "<a href=novy.php?id=" .htmlspecialchars($row->id) ." style=cursor:pointer;>";
     echo "$row->nazev"; 
    echo "</a>"; 
    echo "</td>";    
    
    echo "<td>" . htmlspecialchars($row->jmeno) . "</td>";
    echo "<td>" . htmlspecialchars($row->datum) . "</td>";  
     
  
    echo "</tr>";
  
}
echo "</table>";



 
}


?>