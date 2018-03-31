                            
<?php


 echo "<div class=row>";
 
 if($_SESSION['login']==false){
     echo "<div class=col-md-5>"; 
      echo "Nejste přihlášený";
      exit();
    }
    // id je id radku v tabulce k editaci
  if (isset($_GET["id"]))
      $id = $_GET["id"];
  else
  {
    echo "chybné volání stránky bez id";
    exit;  
   }
  

  
 
  
 require_once("MySQL.php");
  $sql="SELECT * FROM Clanek WHERE idClanek = '".$id."'";
   $vysledek = mysqli_query($databaze,$sql);
   $radek= mysqli_fetch_array($vysledek); 
 
           

  echo "<div class=col-md-1 >";  
  echo "</div>";   

  echo "<div class=col-md-10 >";  

 echo "<form name=edit  method=post action=\"index.php?s=4\">";
echo "<input type=hidden name=id1 value= $id>"; 
 echo" <div class=\"form-group\"> ";
 echo"   <label for=\"nazev\">Zadejte nadpis článku </label>  ";
 echo"   <input type=\"text\" name=\"nazev\" class=\"form-control\"  value=\"" .$radek['nazev'] ."\">";
 echo" </div>  ";
  
  

 echo" <div class=\"form-group\"> ";
 echo"   <label for=\"text\">Zadejte obsah článku  </label>  ";
 echo"   <textarea class=\"form-control\" rows=\"25\" name=\"text\" class=\"form-control\">"  .$radek['text'] ."</textarea> ";
 echo" </div>    "; 
 

 echo "<br><hr><br>"; 


 echo "<div class=row>";

 echo "<div class=col-md-3 >";  
echo" <button type=\"submit\" name=\"tlacitko\" class=\"btn btn-primary\">Uložit</button> ";
 echo "</div>";        
 echo "<div class=col-md-8 >";  
echo" <button type=\"submit\" name=\"blokace\" class=\"btn btn-danger\">Zeblokovat</button> ";
echo " - Touto funkcí moderátor zablokuje článek i jeho autora<br>";
 echo "</div>";        

echo" </form>  ";


  echo "</div>";         
        
    
    
    echo "<br><br>";
    echo "<form action=index.php?s=4>";
    echo" <button type=\"submit\" name=\"tlacitko\" class=\"btn btn-primary\">Návrat zpět</button> ";
    echo "</form>";
    
    
