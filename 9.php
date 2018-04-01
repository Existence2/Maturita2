                                
 <?php

 if ($_SESSION['login']== false)
 {
  echo "<div class=\"alert alert-danger\">";
  echo "Pro práci se webovou stránkou musíte být přihlášen. Přihlaste se prosím";
  echo "</div>";
  exit;
  
 }


 echo "<div class=row>";
 
  echo "<div class=col-md-2 >";  
  echo "</div>";
  
  
  echo "<div class=col-md-8 >";  

 echo "<form role\"form\" method=post >";    
 echo" <div class=\"form-group\"> ";
 echo"   <label for=\"nazev\">Zadejte název revíru </label>  ";
 echo"   <input type=\"text\" name=\"nazev\" class=\"form-control\" id=\"nazev\">  ";
 echo" </div>  ";
 echo" <div class=\"form-group\"> ";
 echo"   <label for=\"lokalita\">Zadejte, v jakém kraji se revír nachází </label>  ";
 echo"   <input type=\"text\" name=\"lokalita\" class=\"form-control\" id=\"lokalita\"> ";
 echo" </div>    ";
  echo" <div class=\"form-group\"> ";
 echo"   <label for=\"popis\">Zadejte popis revíru  </label>  ";
 echo"   <textarea class=\"form-control\" rows=\"5\" name=\"popis\" class=\"form-control\" id=\"popis\"> </textarea> ";
 echo" </div>    ";  
    echo" <div class=\"form-group\"> ";
 echo"   <label for=\"rozmer\">Zadejte rozměr vašeho revíru v kilometrech (povolena dvě desetinná místa) </label>  ";
 echo"   <input type=\"number\"  name=\"rozmer\" step=\"0.01\" class=\"form-control\" id=\"rozmer\"> ";
 echo" </div>    ";
 
 echo" <div class=\"form-group\"> ";
 echo"   <label for=\"svaz\">Zadejte k jakému svazu revír patří </label>  ";
 echo"   <input type=\"text\" name=\"svaz\" class=\"form-control\" id=\"svaz\"> ";
 echo" </div>    ";
 
echo "<button type=\"submit\" name= \"tlacitko\" class=\"btn btn-primary\">Potvrď</button> ";
echo" </form>  ";
  echo "</div>";        
        
        
        
  echo "<div class=col-md-2 >";  
  echo "</div>";   
   echo "</div>";         
     
         require_once("MySQL.php"); 
         if (isset($_REQUEST['tlacitko'])){
         if($_REQUEST['nazev'] <> "" and  $_REQUEST['lokalita'] <>"" and  $_REQUEST['popis'] <>"" and  $_REQUEST['rozmer'] <>""  and  $_REQUEST['svaz'] <>""){       
                    $nazev= $_REQUEST['nazev'];
                		$lokalita= $_REQUEST['lokalita'];
                    $popis= $_REQUEST['popis'];
                    $rozmer= $_REQUEST['rozmer'];
                    $svaz= $_REQUEST['svaz'];
                 
                    $prikaz="SELECT * from Revir";
                    $vysledek = $databaze->query($prikaz);
                    While($radek=$vysledek->fetch_object())
                  
                   {
                    
                      if($radek->nazev == $nazev){
                        echo "<br> <div class=\"alert alert-danger\">Revír se stejným názvem již existuje </div><br> " ;
                        exit();
                        }
                        
                  
                    }
                    
                   $prikaz="INSERT into Revir VALUES('Null',?,?,?,?,?)";
                   $vysledek=$databaze->prepare($prikaz);
                	 $vysledek->bind_param("sssis",$nazev,$lokalita,$popis,$rozmer,$svaz);
                	 $vysledek->execute();
                  echo "<br><div class=\"alert alert-success\">Revír byl úspěšně vložen</div><br>";      
                   }  
           
               
         else{
           echo "<br><div class=\"alert alert-danger\">Nazadal jste některý z údajů </div><br> " ;
         } 
         }

   