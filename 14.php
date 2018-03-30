                                
 <?php

 if($_SESSION['login']==false){
     echo "<div class=col-md-5>"; 
      echo "Nejste přihlášený";
      exit();
    }
    // id je id radku v tabulce k editaci
  if (isset($_REQUEST["id"]))
      $id = $_REQUEST["id"];
  else
  {
    echo "chybné volání stránky bez id";
    exit;  
   }
  

  
 
  
 require_once("MySQL.php");
  $sql="SELECT * FROM Clanek WHERE idClanek = '".$id."'";
   $vysledek = mysqli_query($databaze,$sql);
   $radek= mysqli_fetch_array($vysledek); 
 
 
 echo "<div class=row>";
   echo "<div class=col-md-1 ></div>";
   echo "<div class=col-md-10 >";
 
   echo "<div class=\"well\"><h3>".$radek['nazev'] ."</h3></div>";
   echo "<br>";
   
   
   echo "<div class=row>";
   echo "<div class=col-md-1 ></div>";
   echo "<div class=col-md-10 >";
    echo "<br>";
    echo  nl2br($radek['text']);
    echo "</div>";        
   echo "</div>";    
       
   echo "</div>";        
   echo "</div>";              
    
    
    echo "<br><br>";
    
   echo "<div class=row>";
   echo "<div class=col-md-1 ></div>";
   echo "<div class=col-md-1>";
  
    echo "<form action=index.php?s=4>";
    echo" <button type=\"submit\" name=\"tlacitko\" class=\"btn btn-primary\">Návrat zpět</button> ";
    echo "</form>";
   echo "</div>";              
    
   echo "<div class=col-md-2></div>";
       
   if($_SESSION['pravo']>1){
    $id1=$id;
    
    echo "<form action=index.php?s=1>";
    echo "<div class=col-md-1>";
     echo "<input type=checkbox name=ok >";
      echo "</div>";
     echo "<div class=col-md-3>"; 
    echo" <button type=\"submit\" name=\"blokace\" class=\"btn btn-danger\">Zablokovat článek společně s uživatelem</button> ";
     echo "<input type=hidden name=iduz value=" .$radek['Uzivatel_idUzivatel'] .">";  
     echo "<input type=hidden name=idcl value=" .$id1 .">";  
     echo "</form>";
   }
    echo "</div>";
    echo "</div>";
  
  
