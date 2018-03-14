
<?
 if ($_SESSION['login']== false)
 {
  echo "<div class=\"alert alert-danger\">";
  echo "Pro práci s články musíte být přihlášen. Přihlaste se prosím";
  echo "</div>";
  exit;
  
 }

$q=$_SESSION['id'];

if (isset($_REQUEST["id"]))
{
  include("14.php");
  exit;
  
}
else
{
 	echo '<div class="alert alert-info">  
  Jste přihlášen jako <strong> '.$_SESSION['jmeno'].' </strong> a máte právo';
  if($_SESSION['pravo']==1){
    echo"<strong> uživatele </strong>";
  }
   if($_SESSION['pravo']==2){
    echo"<strong> moderátora </strong>";
  }
   if($_SESSION['pravo']==3){
    echo"<strong> správce </strong>";
  }
echo '</div>';

echo "<table class=\"table table-bordered\">";
echo " <thead>";
echo "<tr>";
  echo "<th>Nadpis</th>";
  echo "<th>Uživatel</th>";
  echo "<th>Datum</th>";
echo "</tr>";
echo "   </thead>";

require_once("MySQL.php"); 
$prikaz = "SELECT Clanek.idClanek as id, Uzivatel.jmeno as jmeno, Clanek.nazev as nazev, Clanek.datum as datum FROM Clanek INNER JOIN Uzivatel WHERE Clanek.Uzivatel_idUzivatel = Uzivatel.idUzivatel AND Clanek.viditelnost=0  ";
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

 if (isset($_REQUEST['blokace'])){
   
   if (isset($_REQUEST['ok'])){
    $a=$_REQUEST['iduz'];
    $b=$_REQUEST['idcl'];
    $sql="UPDATE Clanek SET viditelnost='1' WHERE idClanek = '".$b."'";
    $vysledek = mysqli_query($databaze,$sql);
   
   $sql2="UPDATE Uzivatel SET blokace='1' WHERE idUzivatel = '".$a."'";
   $vysledek2 = mysqli_query($databaze,$sql2);
    if (mysqli_query($databaze, $sql2)) {
      echo "<div class=\"alert alert-danger\">Uživatel s článekm byl zablokován</div>";
    }
  }
  

 

}
}


?>