 <?php 
 echo "<div class=row>";
 
 if($_SESSION['login']==false){
     echo "<div class=col-md-5>"; 
      echo "Nejste přihlášený";
      exit();
    }

  if (isset($_REQUEST["id"])) {
      $id = $_REQUEST["id"];   }
  else
  {
    echo "chybné volání stránky bez id";
    exit;  
   }
  

  
 
  
 require_once("MySQL.php");
  $sql="SELECT * FROM Uzivatel WHERE idUzivatel = '".$id."'";
   $vysledek = mysqli_query($databaze,$sql);
   $radek= mysqli_fetch_array($vysledek); 
 
       

  echo "<div class=col-md-5 >";  

 echo "<form > ";
echo "<input type=hidden name=id1 value= $id>"; 
 echo" <div class=\"form-group\"> ";
 echo"   <label for=\"nazev\">Zadejte jméno uživatele </label>  ";
 echo"   <input type=\"text\" name=\"jmeno\" class=\"form-control\" id=\"jmeno\" value=\"" .$radek['jmeno'] ."\">";
 echo" </div>  ";
  
  echo" <div class=\"form-group\"> ";
 echo"   <label for=\"text\">Zadejte pravo  </label>  ";
 echo"   <input type=\"text\" name=\"pravo\" class=\"form-control\" id=\"pravo\" value=\"" .$radek['pravo'] ."\">";
 echo" </div>    "; 
 
   echo" <div class=\"form-group\"> ";
 echo"   <label for=\"text\">Zadejte blokovanost 0 nebo 1  </label>  ";
 echo"   <input type=\"text\" name=\"blokace\" class=\"form-control\" id=\"blokace\" value=\"" .$radek['blokace'] ."\">";
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
    
?>    