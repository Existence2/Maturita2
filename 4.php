<?


 if ($_SESSION['login']== false)
 {
  echo "<div class=\"alert alert-danger\">";
  echo "Pro práci se stránkami musíte být přihlášen. Přihlaste se prosím";
  echo "</div>";
  exit;
  
 }

$q=$_SESSION['id'];

if (isset($_REQUEST["id"]))
{
  include("40.php");
  exit;
  
}
else
{

 
require_once("MySQL.php"); 

if (isset($_REQUEST['idd']) and isset($_REQUEST['smazej']))
    {
         $idd = $_REQUEST['idd'];
         
              $sql = "DELETE FROM Clanek 
                      WHERE idClanek='$idd'";
                      
               
                    if (mysqli_query($databaze, $sql)) {
                                 echo "Váš článek byl úspěšně smazár";
                      } else {
                            echo "Error: " . $sql . "<br>" . mysqli_error($databaze);
                      } 
                           
                      
         
    } 


echo "<table class=\"table table-bordered\">";
echo " <thead>";
echo "<tr>";
  echo "<th>Nadpis</th>";
  echo "<th>Uživatel</th>";
  echo "<th>Datum</th>";
 // echo "<th></th>";
 // echo "<th></th>";
echo "</tr>";
echo "   </thead>";


if($_SESSION['pravo']>1){$prikaz = "SELECT Clanek.idClanek as id, Uzivatel.jmeno as jmeno, Clanek.nazev as nazev, Clanek.datum as datum FROM Clanek INNER JOIN Uzivatel WHERE Clanek.Uzivatel_idUzivatel = Uzivatel.idUzivatel";}
else{$prikaz = "SELECT Clanek.idClanek as id, Uzivatel.jmeno as jmeno, Clanek.nazev as nazev, Clanek.datum as datum FROM Clanek INNER JOIN Uzivatel WHERE Clanek.Uzivatel_idUzivatel = Uzivatel.idUzivatel AND Uzivatel.idUzivatel='$q' "; }
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
    
      echo "<td>";
    
    $jmenoformulare = "DEL" .$row->id;
    echo "<form name=$jmenoformulare method=post >";
       echo "<input type=hidden name=idd value = $row->id>";
       echo "<input type=\"checkbox\" id=\"smazej\" name=\"smazej\" >";
     echo "</form>"; 
    echo "</td>";
    echo "<td>";
        echo "<span class=\"glyphicon glyphicon-trash\" style=cursor:pointer; onclick = self.document.forms.$jmenoformulare.submit() >";
        
    echo "</td>";
    echo "</tr>";
    
}
echo "</table>";




  
  
  if (isset($_REQUEST['id1'])){
         if($_REQUEST['nazev'] <> "" and  $_REQUEST['text'] <> "" ){       
                      $nazev= htmlentities($_REQUEST['nazev']);
                      $text= htmlentities($_REQUEST['text']);
                      $datum= date('Y-m-d');
                      $id1 = $_REQUEST['id1'];
                    
                    $sql = "UPDATE Clanek SET
                      nazev = '$nazev',
                      text='$text',
                      datum = '$datum'  
                      WHERE idClanek='$id1'";
                     
                   
                       
                    if (mysqli_query($databaze, $sql)) {
                                 echo "Váš článek byl úspěšně aktualizován";
                      } else {
                            echo "Error: " . $sql . "<br>" . mysqli_error($databaze);
                      } 
                           
                
                   }  
                   
  
               
         else{
           echo("nezadal jste některý z údajů");
         } 
         }

 
    
 
}


?>