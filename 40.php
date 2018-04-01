                            
<?php


 echo "<div class=row>";
 
  if ($_SESSION['login']== false)
 {
  echo "<div class=\"alert alert-danger\">";
  echo "Pro práci se stránkami musíte být přihlášen. Přihlaste se prosím";
  echo "</div>";
  exit;
  
 }

  if (isset($_GET["id"]))
      $id = $_GET["id"];
  else
  {
     echo "<div class=\"alert alert-danger\">chybné volání stránky bez id </div>";
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
echo "<input type=hidden name=iduz value=" .$radek['Uzivatel_idUzivatel'] .">"; 
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
echo" <button type=\"submit\" name=\"uloz\" class=\"btn btn-primary\">Uložit</button> ";
 echo "</div>";        
 
 
 $pravo = $_SESSION['pravo'];
 if($pravo>1){
  echo "<div class=col-md-8 >";  
 
   if ($radek['viditelnost'] == 0)
   {
    echo " <button type=\"submit\" name=\"blokace\" class=\"btn btn-danger\">Zablokovat</button> ";
    echo " - Touto funkcí moderátor zablokuje článek i jeho autora<br>";
   }
   else
   {
    echo " <button type=\"submit\" name=\"odblokace\" class=\"btn btn-success\">Odblokovat</button> ";
    echo " - Touto funkcí moderátor odblokuje článek. Autora musí odblokovat ručně. <br>";
   }
   


  echo "</div>";        
 } 
 
echo" </form>  ";


  echo "</div>";         
        
    
    
    echo "<br><br>";
    echo "<form action=index.php?s=4>";
    echo" <button type=\"submit\" name=\"tlacitko\" class=\"btn btn-primary\">Návrat zpět</button> ";
    echo "</form>";
    
    
