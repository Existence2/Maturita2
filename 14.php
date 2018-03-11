                                
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

 
 
 
 
 /*      
 
 
 

  echo "<div class=col-md-5 >";  

 echo "<form > ";
echo "<input type=hidden name=id1 value= $id>"; 
 echo" <div class=\"form-group\"> ";
 echo"   <label for=\"nazev\">Nadpis článku </label>  ";
 echo"   <input type=\"text\" name=\"nazev\" readonly class=\"form-control\" id=\"nazev\" value=\"" .$radek['nazev'] ."\">";
 echo" </div>  ";
  
  echo" <div class=\"form-group\"> ";
 echo"   <label for=\"text\">Obsah článku  </label>  ";
 echo"   <textarea readonly class=\"form-control\" rows=\"25\" name=\"text\" class=\"form-control\" id=\"text\">" .$radek['text'] ."</textarea> ";
 echo" </div>    "; 
 
        
  echo "<div class=col-md-2 >";  
  echo "</div>";        
        
      
     */
     
     
        
   echo "</div>";        
   echo "</div>";              
    
    
    echo "<br><br>";
    echo "<form action=novy.php?s=4>";
    echo" <button type=\"submit\" name=\"tlacitko\" class=\"btn btn-primary\">Návrat zpět</button> ";
    echo "</form>";
    
    
