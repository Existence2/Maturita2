 <?php 
 echo "<div class=row>";
 
if($_SESSION['pravo']<3 OR $_SESSION['login']==FALSE){  
   echo "<div class=\"alert alert-danger\">";
  echo "Pro práci s uživateli musíte být přihlášen. Přihlaste se prosím";
  echo "</div>";
  exit;}

  if (isset($_REQUEST["id"])) {
      $id = $_REQUEST["id"];   }
  else
  {
     echo "<div class=\"alert alert-danger\">chybné volání stránky bez id </div>";
    exit;  
   }
  

  
 
  
 require_once("MySQL.php");
  $sql="SELECT * FROM Uzivatel WHERE idUzivatel = '".$id."'";
   $vysledek = mysqli_query($databaze,$sql);
   $radek= mysqli_fetch_array($vysledek); 
 
       
  echo "<div class=col-md-3 ></div>";  
  echo "<div class=col-md-5 >";  
  
  echo "<h2>Editace uživatele</h2>";
  echo "<br>";

 echo "<form > ";
echo "<input type=hidden name=id1 value= $id>"; 
 echo" <div class=\"form-group\"> ";
 echo"   <label for=\"nazev\">Zadejte jméno uživatele </label>  ";
 echo"   <input type=\"text\" name=\"jmeno\" class=\"form-control\" id=\"jmeno\" value=\"" .$radek['jmeno'] ."\">";
 echo" </div>  ";
  
  echo" <div class=\"form-group\"> ";
 echo"   <label for=\"text\">Zadejte pravo 1-uživatel, 2-moderátor, 3-správce </label>  ";
 echo"   <input type=\"text\" name=\"pravo\" class=\"form-control\" id=\"pravo\" value=\"" .$radek['pravo'] ."\">";
 echo" </div>    "; 
 
   echo" <div class=\"form-group\"> ";
 echo"   <label for=\"text\">Zadejte blokovanost 0 nebo 1  </label>  ";
 echo"   <input type=\"text\" name=\"blokace\" class=\"form-control\" id=\"blokace\" value=\"" .$radek['blokace'] ."\">";
 echo" </div>    "; 
 
 echo" <button type=\"submit\" name=\"tlacitko\" class=\"btn btn-primary\">Potvrď</button> ";
echo" </form>  ";



    
    echo "<br><br>";
    echo "<form action=index.php?s=4>";
    echo" <button type=\"submit\" name=\"tlacitko\" class=\"btn btn-primary\">Návrat zpět</button> ";
    echo "</form>";


  echo "</div>";        
        
        
        
  echo "<div class=col-md-2 >";  
  echo "</div>";   
  echo "</div>";         
        
      
 
        
        
    
    
?>    