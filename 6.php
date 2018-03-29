                                
 <?php
     if($_SESSION["login"]==true){

 echo "<div class=row>";
 
  echo "<div class=col-md-2 >";  
  echo "</div>";
  
  
  echo "<div class=col-md-8 >";  

  echo"   <form>   ";    
 echo" <div class=\"form-group\"> ";
 echo"   <label for=\"rozmer\">Zadejte rozměr vašeho úlovku (cm)</label>  ";
 echo"   <input type=\"number\" class=\"form-control\" name=\"rozmer\" id=\"rozmer\">  ";
 echo" </div>  ";
 echo" <div class=\"form-group\"> ";
 echo"   <label for=\"vaha\">Zadejte váhu vašeho úlovku v kg (dvě desetinná místa) </label>  ";
 echo"   <input type=\"text\" class=\"form-control\" name=\"vaha\" id=\"vaha\"> ";
 echo" </div>    ";
  echo" <div class=\"form-group\"> ";
 echo"   <label for=\"datum\">Zadejte datum vašeho úlovku</label>  ";
 echo"   <input type=\"date\" class=\"form-control\" name=\"datum\" id=\"datum\"> ";
 echo" </div>    ";

    echo" <div class=\"form-group\"> ";
 echo"   <label for=\"lov\">Zadejte způsob lovu vašeho úlovku</label>  ";
 echo"   <input type=\"text\" class=\"form-control\"  name=\"lov\" id=\"lov\"> ";
 echo" </div>    ";
 
    
    echo" <div class=\"form-group\"> ";
 echo"   <label for=\"ryba\">Vyberte rybu </label>  ";
 	
		echo "<select name=\"ryba\" id=\"ryba\" class=\"form-control\" size=1 >";
    
         
require_once("MySQL.php");     
     
     
     
 $prikaz = "SELECT idDruh, nazev  FROM Druh ";
 $tabulka=$databaze->query($prikaz); 
 if ($tabulka->num_rows==0)
   {  
    echo "<div class=\"alert alert-danger\">";
  echo "Je nutné vložit minimálně 1 druh ryb pro funkčnost webových stránek.";
  echo "</div>";
  exit;}
    
    
     While($radek=$tabulka->fetch_object())
   {
             
           echo "<option value = ";
            echo $radek->idDruh; 
            echo " >";
            echo $radek->nazev;
			     echo "</option>";	
    
   }  
     echo "</select>";					 
 
 echo" </div>    ";
 
 
    echo" <div class=\"form-group\"> ";
 echo"   <label for=\"revir\">Vyberte revír </label>  ";
		echo "<select name=\"revir\" id=\"revir\" class=\"form-control\" size=1 >";
     
     
     
     
 $prikaz = "SELECT idRevir, nazev  FROM Revir ";
 $tabulka=$databaze->query($prikaz); 
 if ($tabulka->num_rows==0)
   {  
  echo "<div class=\"alert alert-danger\">";
  echo "Je nutné vložit minimálně 1 revír pro funkčnost webových stránek.";
  echo "</div>";
  exit;}
    
    
     While($radek=$tabulka->fetch_object())
   {
             
           echo "<option value = ";
             echo $radek->idRevir;
            echo " >";
            echo $radek->nazev;
			     echo "</option>";	
    
   }  
     echo "</select>";

     
 echo" </div>    ";
 
 echo" <button type=\"submit\" name=\"tlacitko\" class=\"btn btn-primary\">Potvrď</button> ";
echo" </form>  ";
  echo "</div>";        
        
        
        
  echo "<div class=col-md-2 >";  
  echo "</div>";   
   echo "</div>";         
        
      
 if (isset($_REQUEST['tlacitko'])){
         if($_REQUEST['rozmer'] <> "" and  $_REQUEST['vaha'] <>"" and  $_REQUEST['datum'] <>"" and $_REQUEST['lov'] <>""){       
                    $rozmer= $_REQUEST['rozmer'];
                		$vaha= $_REQUEST['vaha'];
                    $lov= $_REQUEST['lov'];
                    $datum= $_REQUEST['datum'];
                    $druh= $_REQUEST['ryba'];
                    $revir= $_REQUEST['revir'];
                    $iduzivatele =  $_SESSION['id'];
                    
                    $sql = "INSERT INTO Ulovek (rozmer, vaha, datum, zpusob_lovu, Revir_idRevir, Druh_idDruh, Uzivatel_idUzivatel) VALUES ('$rozmer','$vaha','$datum','$lov','$revir','$druh','$iduzivatele' )";
                 
                    if (mysqli_query($databaze, $sql)) {
                                 echo "<div class=\"alert alert-successful\">";
                                  echo "Váš úlovek byl úspěšně vložen.";
                                  echo "</div>";
                                  exit;   }
                      else {
                            echo "Error: " . $sql . "<br>" . mysqli_error($databaze);
                      } 
                           
                   /*$prikaz="INSERT into Druh VALUES('Null',?,?,?,?,?,?,?)";
                     $vysledek=$databaze->prepare($prikaz);
                      var_dump($vysledek);
                     $vysledek->bind_param("iissiii",$rozmer,$vaha,$datum,$lov,$revir,$druh,$iduzivatele);
                      $vysledek->execute();
                      */
                   }  
                   
  
               
         else{
           echo "<div class=\"alert alert-danger\">";
                echo "Nezadal jste některý z údajů";
                echo "</div>";
                exit;
         } 
         }
 
 
   
 
 
 
        
        } 
    if($_SESSION["login"]==false){
        echo "<div class=\"alert alert-danger\">";
        echo "Nejste přihlášený.";
        echo "</div>";
        exit();}
   