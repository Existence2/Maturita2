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


if (isset($_REQUEST['idd']) and isset($_REQUEST['smazej']))
    {
         $idd = $_REQUEST['idd'];
         
              $sql = "DELETE FROM Revir 
                      WHERE idRevir='$idd'";
                      
               
                    if (mysqli_query($databaze, $sql)) {
                                 echo "Váš revír byl úspěšně smazán";
                      } else {
                            echo "Error: " . $sql . "<br>" . mysqli_error($databaze);
                      } 
                           
                      
         
    } 



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
                     $id =   $_REQUEST['id1']; 
                    
                    $sql = "UPDATE Revir SET
                      nazev = '$nazev',
                      kraj='$lokalita',
                      popis = '$popis',
                      velikost ='$rozmer',
                      svaz = '$svaz'
                      WHERE idRevir='$id'";
                       
                   
                       
                    if (mysqli_query($databaze, $sql)) {
                                echo " <div class='alert alert-success'>
                            Váš revír byl <strong>aktualizován</strong> 
                                          </div> ";
                      } else {
                            echo "Error: " . $sql . "<br>" . mysqli_error($databaze);
                      } 
                           

                   }  
                   
  
               
         else{
           echo("nezadal jste některý z údajů");
         } 
         }
 
 
  $sql="SELECT * from Revir ";
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
    
    echo "<td>" . htmlspecialchars($row->kraj) . "</td>";
    echo "<td>" . htmlspecialchars($row->popis) . "</td>";
    echo "<td>" . $row->velikost . "</td>";
    echo "<td>" . $row->svaz. "</td>";
       
      
    echo "<td>";
    
    $jmenoformulare = "DEL" .$row->idRevir;
    echo "<form name=$jmenoformulare method=post >";
    echo "<input type=hidden name=idd value = $row->idRevir>";
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