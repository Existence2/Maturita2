                                
 <?php

 echo "<div class=row>";
 
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
 
       

  echo "<div class=col-md-5 >";  

 echo "<form > ";
echo "<input type=hidden name=id1 value= $id>"; 
 echo" <div class=\"form-group\"> ";
 echo"   <label for=\"nazev\">Zadejte nadpis článku </label>  ";
 echo"   <input type=\"text\" name=\"nazev\" class=\"form-control\" id=\"nazev\" value=\"" .$radek['nazev'] ."\">";
 echo" </div>  ";
  
  echo" <div class=\"form-group\"> ";
 echo"   <label for=\"text\">Zadejte obsah článku  </label>  ";
 echo"   <textarea class=\"form-control\" rows=\"25\" name=\"text\" class=\"form-control\" id=\"text\">" .$radek['text'] ."</textarea> ";
 echo" </div>    "; 
 
 
 echo" <button type=\"submit\" name=\"tlacitko\" class=\"btn btn-primary\">Potvrď</button> ";
echo" </form>  ";
  echo "</div>";        
        
        
        
  echo "<div class=col-md-2 >";  
  echo "</div>";   
  echo "</div>";         
        
      
 
        
        
    
    
    echo "<br><br>";
    echo "<form action=index.php?s=4>";
    echo" <button type=\"submit\" name=\"tlacitko\" class=\"btn btn-primary\">Návrat zpět</button> ";
    echo "</form>";
    
    
