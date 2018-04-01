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
require_once("MySQL.php"); 

 if ($_SESSION['login']== false)
 {
  echo "<div class=\"alert alert-danger\">";
  echo "Pro práci se webovou stránkou musíte být přihlášen. Přihlaste se prosím";
  echo "</div>";
  exit;
  
 }
if (isset($_REQUEST['idd']) and isset($_REQUEST['smazej']))
    {
         $idd = $_REQUEST['idd'];
         
              $sql = "DELETE FROM Druh 
                      WHERE idDruh='$idd'";
                      
               
                    if (mysqli_query($databaze, $sql)) {
                                echo " <div class='alert alert-success'>Váš druh byl úspěšně smazán </div>";
                      } else {
                            echo "Error: " . $sql . "<br>" . mysqli_error($databaze);
                      } 
                           
                      
         
    } 

if (isset($_REQUEST["id"]))
{
  include("62.php");
}
else
{
  
  
  if (isset($_REQUEST['id1'])){
          if($_REQUEST['nazev'] <> "" and  $_REQUEST['rad'] <>"" and  $_REQUEST['celed'] <>"" and  $_REQUEST['zacatek'] <>""  and  $_REQUEST['konec'] <>""  and  $_REQUEST['potrava'] <>""  and  $_REQUEST['navnada'] <>""  and  $_REQUEST['popis'] <>""){       
                    $nazev= $_REQUEST['nazev'];
                		$rad= $_REQUEST['rad'];
                    $celed= $_REQUEST['celed'];
                    $zacatek = $_REQUEST['zacatek'];
                    $konec= $_REQUEST['konec'];
                    $potrava= $_REQUEST['potrava'];
                    $navnada= $_REQUEST['navnada'];
                    $popis= $_REQUEST['popis'];
                    $id= $_REQUEST['id1']; 
                    $sql = "UPDATE Druh SET
                      nazev = '$nazev',
                      rad='$rad',
                      celed = '$celed',
                      zacatek_hajeni ='$zacatek',
                      konec_hajeni = '$konec',
                      potrava = '$potrava',
                      navnada = '$navnada',
                      popis =  '$popis'
                      WHERE idDruh='$id'";
                       
                   
                       
                    if (mysqli_query($databaze, $sql)) {
                                echo " <div class='alert alert-success'>
                            Váš druh byl <strong>aktualizován</strong> 
                                          </div> ";
                      } else {
                            echo "Error: " . $sql . "<br>" . mysqli_error($databaze);
                      } 
                           

                   }  
                   
  
               
         else{
           echo" <div class='alert alert-danger'>Nezadal jste některý z údajů, aktualizace se nepodařila </div>" ;
         } 
         }
 
 
  $sql="SELECT * from Druh ";
  $tabulka=$databaze->query($sql); 

 
    
  
  
  
echo "<table class=\"table table-bordered\">";
echo " <thead>";
echo "<tr>";
echo "<th>Název</th>";
echo "<th>Řád</th>";
echo "<th>Čeleď</th>";
echo "<th>Začátek</th>";
echo "<th>Konec</th>";
echo "<th>Potrava</th>";
echo "<th>Návnada</th>";
echo "<th>Popis</th>";
echo "</tr>";
echo "   </thead>";

while($row=$tabulka->fetch_object()) {
 
    echo "<tr>";
    echo "<td>";
     echo "<a href=index.php?id=" .$row->idDruh ." style=cursor:pointer;>";
     echo $row->nazev; 
    echo "</a>"; 
    echo "</td>";    
    
    echo "<td>" . $row->rad . "</td>";
    echo "<td>" . $row->celed . "</td>";
    echo "<td>" . $row->zacatek_hajeni . "</td>";
    echo "<td>" . $row->konec_hajeni. "</td>";
    echo "<td>" . $row->potrava. "</td>";
    echo "<td>" . $row->navnada. "</td>";
    echo "<td>" . $row->popis. "</td>";   
    
    echo "<td>";
    
    $jmenoformulare = "DEL" .$row->idDruh;
    echo "<form name=$jmenoformulare method=post >";
    echo "<input type=hidden name=idd value = $row->idDruh>";
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
</body>
</html>