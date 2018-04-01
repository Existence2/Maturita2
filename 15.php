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
 echo "<div class=row>";
        
 echo "<div class=col-md-2 ></div>";  
  echo "<div class=col-md-8 >";  
  
  
if($_SESSION['pravo']<3 OR $_SESSION['login']==FALSE){  
   echo "<div class=\"alert alert-danger\">";
  echo "Pro práci s uživateli musíte být přihlášen. Přihlaste se prosím";
  echo "</div>";
  exit;}
  
    

else{
$q=$_SESSION['id'];


if (isset($_REQUEST['idd']) and isset($_REQUEST['smazej']))
    {
         $idd = $_REQUEST['idd'];
         
              $sql = "DELETE FROM Uzivatel 
                      WHERE idUzivatel='$idd'";
                      
               
                    if (mysqli_query($databaze, $sql)) {
                                 echo "<br><div class=\"alert alert-success\">Uživatel byl úspěšně smazán</div><br>";
                      } else {
                            echo "Error: " . $sql . "<br>" . mysqli_error($databaze);
                      } 
                           
                      
         
    } 



if (isset($_REQUEST["id"]))
{
  include("155.php");
}
else
{

  
  if (isset($_REQUEST['id1'])){
         if($_REQUEST['jmeno'] <> "" and  $_REQUEST['pravo'] <> "" and  $_REQUEST['blokace'] <> ""){       
                    $jmeno= $_REQUEST['jmeno'];
                		$pravo = $_REQUEST['pravo'];
                    $blokovany = $_REQUEST['blokace'];
                     $id =   $_REQUEST['id1']; 
                     
                    $sql = "UPDATE Uzivatel SET
                      jmeno = '$jmeno',
                      pravo ='$pravo',
                      blokace = '$blokovany'
                       WHERE idUzivatel='$id'";
                       
                   
                       
                    if (mysqli_query($databaze, $sql)) {
                                echo " <div class='alert alert-success'>
                            Uživatel byl <strong>aktualizován</strong> 
                                          </div> ";
                      } else {
                            echo "Error: " . $sql . "<br>" . mysqli_error($databaze);
                      } 

                   }  
                   
  
               
         else{
           echo"<br> <div class='alert alert-danger'>Nezadal jste některý z údajů </div><br>" ;
         } 
         }
 
 
    

    $sql="SELECT * from Uzivatel ";
  $tabulka=$databaze->query($sql);   
  
  
echo "<h2 style=text-align:center;>Uživatelé</h2><br>";  
echo "<table class=\"table table-bordered\">";
echo " <thead>";
echo "<tr>";
echo "<th>Id uživatele</th>";
echo "<th>Uživatel</th>";
echo "<th>Právo</th>";
echo "<th>Blokace</th>";
echo "</tr>";
echo "   </thead>";

while($row=$tabulka->fetch_object()) {
     echo "<tr>";
     echo "<tr>";
    echo "<td>";
     echo "<a href=index.php?id=" .$row->idUzivatel ." style=cursor:pointer;>";
     echo $row->idUzivatel; 
    echo "</a>"; 
    echo "</td>";    
    echo "<td>" . $row->jmeno . "</td>";
    echo "<td>" . $row->pravo . "</td>";
      echo "<td>" .$row->blokace . "</td>";
	  
     echo "</tr>";

}
 echo "</table>"; 

}
  
  

 
}

  
  

//mysqli_close($databaze);
  echo "</div>";   
  echo "</div>";
?>
</body>
</html>