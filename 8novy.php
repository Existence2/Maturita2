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
 require("../CONNECT/CONNECT.php"); 
  $databaze=new mysqli($host, $user, $password, $db) or die("connect ERROR");
  $databaze->set_charset("utf8");
  if ($databaze->connect_errno){
  printf("Pripojeni spadlo: %s\n", $databaze->connect_error);
       exit();
            }

$q=$_SESSION['id'];


if (isset($_REQUEST["id"]))
{
  include("61.php");
}
else
{
  
  
  if (isset($_REQUEST['id1'])){
          if($_REQUEST['nazev'] <> "" and  $_REQUEST['lokalita'] <>"" and  $_REQUEST['popis'] <>"" and  $_REQUEST['rozmer'] <>""  and  $_REQUEST['svaz'] <>""){       
                    $nazev= $_REQUEST['nazev'];
                		$lokalita= $_REQUEST['lokalita'];
                    $popis= $_REQUEST['popis'];
                    $rozmer= $_REQUEST['rozmer'];
                    $svaz= $_REQUEST['svaz'];
                    
                    
                    $sql = "UPDATE Revir SET
                      nazev = '$rozmer',
                      lokalita='$vaha',
                      popis = '$datum',
                      rozmer ='$lov',
                      svaz = '$revir',
                       WHERE idRevir='$id'";
                       
                   
                       
                    if (mysqli_query($databaze, $sql)) {
                                 echo "Váš Revir byl úspěšně aktualizován";
                      } else {
                            echo "Error: " . $sql . "<br>" . mysqli_error($databaze);
                      } 
                           
                //   vaha, datum, zpusob_lovu, Revir_idRevir, Druh_idDruh, Uzivatel_idUzivatel) VALUES ('$rozmer','$vaha','$datum','$lov','$revir','$druh','$iduzivatele' )
                   }  
                   
  
               
         else{
           echo("nezadal jste některý z údajů");
         } 
         }
 
 
   $sql="SELECT * from revir WHERE idRevir='".$q."'";
  $tabulka=$databaze->query($sql); 

 
    
  
  
  
echo "<table class=\"table table-bordered\">";
echo " <thead>";
echo "<tr>";
echo "<th>Název</th>";
echo "<th>Lokalita</th>";
echo "<th>Popis</th>";
echo "<th>Rozměr</th>";
echo "<th>Svaz</th>";
echo "</tr>";
echo "   </thead>";

while($row=$tabulka->fetch_object()) {
 
    echo "<tr>";
    echo "<td>";
     echo "<a href=index.php?id=" .$row->idRevir ." style=cursor:pointer;>";
     echo $row->nazev; 
    echo "</a>"; 
    echo "</td>";    
    
    echo "<td>" . $row->lokalita . "</td>";
    echo "<td>" . $row->popis . "</td>";
    echo "<td>" . $row->rozmer . "</td>";
    echo "<td>" . $row->svaz. "</td>";
       
    
    echo "</tr>";
  
}
echo "</table>";

}
//mysqli_close($databaze);


?>
</body>
</html>