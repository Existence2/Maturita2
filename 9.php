                                
 <?php
     if($_SESSION["login"]==true){
        echo $_SESSION['jmeno']." jste přihlášený";
         $t4="submit";  
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
 echo"   <label for=\"popis\">Zadejte popis vašeho revíru </label> ";
 echo"   <input type=\"text\"  name=\"popis\" class=\"form-control\" id=\"popis\"> ";
 echo" </div>    ";
    echo" <div class=\"form-group\"> ";
 echo"   <label for=\"rozmer\">Zadejte rozměr vašeho revíru v kilometrech (povolena dvě desetinná místa) </label>  ";
 echo"   <input type=\"number\" name=\"rozmer\" class=\"form-control\" id=\"rozmer\"> ";
 echo" </div>    ";
 
 echo" <div class=\"form-group\"> ";
 echo"   <label for=\"svaz\">Zadejte k jakému svazu revír patří </label>  ";
 echo"   <input type=\"text\" name=\"svaz\" class=\"form-control\" id=\"svaz\"> ";
 echo" </div>    ";
 
echo "<button type=\"submit\" name= \"tlacitko\" class=\"btn btn-primary\">$t4</button> ";
echo" </form>  ";
  echo "</div>";        
        
        
        
  echo "<div class=col-md-2 >";  
  echo "</div>";   
   echo "</div>";         
     
          require("../CONNECT/CONNECT.php"); 
          $databaze=new mysqli($host, $user, $password, $db) or die("connect ERROR");
          $databaze->set_charset("utf8");
          if ($databaze->connect_errno){
            printf("Pripojeni spadlo: %s\n", $databaze->connect_error);
            exit();
          }
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
                        echo "Revír se stejným názvem již existuje " ;
                        exit();
                        }
                        
                  
                    }
                    
                   $prikaz="INSERT into Revir VALUES('Null',?,?,?,?,?)";
                   $vysledek=$databaze->prepare($prikaz);
                	 $vysledek->bind_param("sssis",$nazev,$lokalita,$popis,$rozmer,$svaz);
                	 $vysledek->execute();      
                   }  
           
               
         else{
           echo("nezadal jste některý z údajů");
         } 
         }
     } 
  if($_SESSION["login"]==false){
    echo "Nejste přihlášený";
    exit();
    }
   