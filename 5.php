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
 if ($_SESSION['login']== false)
 {
  echo "<div class=\"alert alert-danger\">";
  echo "Pro práci s úlovky musíte být přihlášen. Přihlaste se prosím";
  echo "</div>";
  exit;
  
 }

header('Content-Type: text/html; charset=utf-8');
 require("../CONNECT/CONNECT.php"); 
  $databaze=new mysqli($host, $user, $password, $db) or die("connect ERROR");
  $databaze->set_charset("utf8");
  if ($databaze->connect_errno){
  printf("Pripojeni spadlo: %s\n", $databaze->connect_error);
       exit();
            }
//mysqli_select_db($databaze,"Ulovek");
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


/*
$sql="SELECT * FROM Ulovek WHERE Uzivatel_idUzivatel = '".$q."'";
$sql2="SELECT Druh.nazev FROM Druh, Ulovek WHERE Ulovek.Druh_idDruh = Druh.idDruh";
$sql3="SELECT Revir.nazev FROM Revir, Ulovek WHERE Ulovek.Revir_idRevir = Revir.idRevir";
$result = mysqli_query($databaze,$sql);
$result2 = mysqli_query($databaze,$sql2);
$result3 = mysqli_query($databaze,$sql3);
  */



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