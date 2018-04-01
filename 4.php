<?


 if ($_SESSION['login']== false)
 {
  echo "<div class=\"alert alert-danger\">";
  echo "Pro práci se stránkami musíte být přihlášen. Přihlaste se prosím";
  echo "</div>";
  exit;
  
 }

$q=$_SESSION['id'];

if (isset($_GET["id"]))
{
  include("40.php");
  exit;
  
}
else
{

 
require_once("MySQL.php"); 

if (isset($_POST['idd']) and isset($_POST['smazej']))
    {
         $idd = $_POST['idd'];
         
              $sql = "DELETE FROM Clanek 
                      WHERE idClanek='$idd'";
                      
               
                    if (mysqli_query($databaze, $sql)) {
                                echo "<br><div class=\"alert alert-success\">Článek byl úspěšně smazán</div><br>";
                      } else {
                            echo "Error: " . $sql . "<br>" . mysqli_error($databaze);
                      } 
                           
                      
         
    } 


     
     if (isset($_POST['id1'])){
         if($_POST['nazev'] <> "" and  $_POST['text'] <> "" ){       
                      $nazev= htmlentities($_POST['nazev']);
                      $text= htmlentities($_POST['text']);
                      $datum= date('Y-m-d');
                      $id1 = $_POST['id1'];
					  $iduz= $_POST['iduz'];
                    
					
					
				if (isset($_POST['uloz']))
				{	
					
                    $sql = "UPDATE Clanek SET
                      nazev = '$nazev',
                      text='$text',
                      datum = '$datum'  
                      WHERE idClanek='$id1'";
                     
                   
                       
                    if (mysqli_query($databaze, $sql)) {
                              echo "<div class=\"alert alert-success\">";
                              echo "Váš článek byl aktualizován.";
                              echo "</div>";
                      } else {
                            echo "Error: " . $sql . "<br>" . mysqli_error($databaze);
                      } 
				}

				if (isset($_POST['blokace']))
				{ 
				    $sql="UPDATE Clanek SET viditelnost='1' WHERE idClanek = '".$id1 ."'";
				    $vysledek = mysqli_query($databaze,$sql);
   
				   $sql2="UPDATE Uzivatel SET blokace='1' WHERE idUzivatel = '".$iduz."'";
				   $vysledek2 = mysqli_query($databaze,$sql2);
				   
				   if (mysqli_query($databaze, $sql2)) {
			    	  echo "<div class=\"alert alert-danger\">Uživatel společně s článkem byl zablokován</div>";
				    }
			    }
				
				
				if (isset($_POST['odblokace']))
				{ 
				    $sql="UPDATE Clanek SET viditelnost='0' WHERE idClanek = '".$id1 ."'";
				    $vysledek = mysqli_query($databaze,$sql);
   
				   
				   if (mysqli_query($databaze, $sql)) {
			    	  echo "<div class=\"alert alert-success\">Článek byl odblokován</div>";
				    }
			    }
				
         
		 
		 }  
         else{
             echo"<br> <div class='alert alert-danger'>Nezadal jste některý z údajů </div><br>" ;
         } 
         }



echo "<table class=\"table table-bordered\">";
echo " <thead>";
echo "<tr>";
  echo "<th>Nadpis</th>";
  echo "<th>Uživatel</th>";
  echo "<th>Datum</th>";
  echo "<th>Zablokovaný</th>";
 // echo "<th></th>";
 // echo "<th></th>";
echo "</tr>";
echo "   </thead>";


if($_SESSION['pravo']>1){$prikaz = "SELECT Clanek.idClanek as id, Uzivatel.jmeno as jmeno, Clanek.nazev as nazev, Clanek.datum as datum, Clanek.viditelnost as viditelny FROM Clanek INNER JOIN Uzivatel WHERE Clanek.Uzivatel_idUzivatel = Uzivatel.idUzivatel ";}
else{$prikaz = "SELECT Clanek.idClanek as id, Uzivatel.jmeno as jmeno, Clanek.nazev as nazev, Clanek.datum as datum, Clanek.viditelnost as viditelny FROM Clanek INNER JOIN Uzivatel WHERE Clanek.Uzivatel_idUzivatel = Uzivatel.idUzivatel AND Uzivatel.idUzivatel='$q' "; }
$tabulka = $databaze->query($prikaz); 
while($row=$tabulka->fetch_object()) {
 
    echo "<tr>";
    echo "<td>";
     echo "<a href=index.php?id=" .htmlspecialchars($row->id) ." style=cursor:pointer;>";
     echo "$row->nazev"; 
    echo "</a>"; 
    echo "</td>";    
    
    echo "<td>" . htmlspecialchars($row->jmeno) . "</td>";
    echo "<td>" . htmlspecialchars($row->datum) . "</td>";  
   echo "<td>" . htmlspecialchars($row->viditelny) . "</td>";  
    
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


  
    
   
 

 
    
 
}


?>