<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN">
<html>
  <head>
  <meta http-equiv="content-type" content="text/html; charset=utf-8">
  <meta name="generator" content="PSPad editor, www.pspad.com">
  <title></title>
 
 <style>
        {include 'tabulka.css'}
</style>
</head>
<body>

<?php
 if ($_SESSION['login']== false)
 {
  echo "<div class=\"alert alert-danger\">";
  echo "Pro práci s úlovky musíte být přihlášen. Přihlaste se prosím";
  echo "</div>";
  exit;
  
 }


require_once("MySQL.php"); 
$q=$_SESSION['id'];

if (isset($_REQUEST['idd']) and isset($_REQUEST['smazej']))
    {
         $idd = $_REQUEST['idd'];
         
              $sql = "DELETE FROM Ulovek 
                      WHERE idUlovek='$idd'";
                      
               
                    if (mysqli_query($databaze, $sql)) {
                                 echo "Váš úlovek byl úspěšně smazán";
                      } else {
                            echo "Error: " . $sql . "<br>" . mysqli_error($databaze);
                      } 
                           
                      
         
    } 



if (isset($_REQUEST["id"]))
{
  include("60.php");
}
else
{
  
  
  if (isset($_REQUEST['id1'])){
         if($_REQUEST['rozmer'] <> "" and  $_REQUEST['vaha'] <>"" and  $_REQUEST['datum'] <>"" and $_REQUEST['lov'] <>""){       
                    $rozmer= $_REQUEST['rozmer'];
                		$vaha= $_REQUEST['vaha'];
                    $lov= $_REQUEST['lov'];
                    $druh= $_REQUEST['ryba'];
                    $revir= $_REQUEST['revir'];
                    $datum= $_REQUEST['datum'];
                    $id =   $_REQUEST['id1'];
                    
                    $iduzivatele =  $_SESSION['id'];
                    
                    $sql = "UPDATE Ulovek SET
                      rozmer = '$rozmer',
                      vaha='$vaha',
                      datum = '$datum',
                      zpusob_lovu ='$lov',
                      Revir_idRevir = '$revir',
                      Druh_idDruh = '$druh',
                      Uzivatel_idUzivatel = '$iduzivatele'  
                       WHERE idUlovek='$id'";
                       
                   
                       
                    if (mysqli_query($databaze, $sql)) {
                                 echo "Váš úlovek byl úspěšně aktualizován";
                      } else {
                            echo "Error: " . $sql . "<br>" . mysqli_error($databaze);
                      } 
                           
                //   vaha, datum, zpusob_lovu, Revir_idRevir, Druh_idDruh, Uzivatel_idUzivatel) VALUES ('$rozmer','$vaha','$datum','$lov','$revir','$druh','$iduzivatele' )
                   }  
                   
  
               
         else{
           echo("nezadal jste některý z údajů");
         } 
         }
 
 
   $sql="SELECT Ulovek.*,Druh.nazev as dnazev, Revir.nazev as rnazev FROM Ulovek 
  left join Druh on Ulovek.Druh_idDruh = Druh.idDruh
  left join Revir on Ulovek.Revir_idRevir = Revir.idRevir  	   	 
  WHERE Uzivatel_idUzivatel = '".$q."'"
  ;
  $tabulka=$databaze->query($sql); 

 
    
  
  
  
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

while($row=$tabulka->fetch_object()) {
 
    echo "<tr>";
    echo "<td>";
     echo "<a href=novy.php?id=" .$row->idUlovek ." style=cursor:pointer;>";
     echo $row->rozmer; 
    echo "</a>"; 
    echo "</td>";    
    
    echo "<td>" . $row->vaha . "</td>";
    echo "<td>" . $row->datum . "</td>";
    echo "<td>" . $row->zpusob_lovu . "</td>";
    echo "<td>" . $row->dnazev. "</td>";
    echo "<td>" . $row->rnazev. "</td>";          
    
     echo "<td>";
    
    $jmenoformulare = "DEL" .$row->idUlovek;
    echo "<form name=$jmenoformulare method=post >";
    echo "<input type=hidden name=idd value = $row->idUlovek>";
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
//mysqli_close($databaze);


?>
</body>
</html>