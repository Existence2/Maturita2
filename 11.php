                                
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
 echo"   <label for=\"nazev\">Zadejte název druhu ryby </label>  ";
 echo"   <input type=\"text\" name=\"nazev\" class=\"form-control\" id=\"nazev\">  ";
 echo" </div>  ";
 echo" <div class=\"form-group\"> ";
 echo"   <label for=\"rad\">Zadejte k jakému řádu ryba patří </label>  ";
 echo"   <input type=\"text\" name=\"rad\" class=\"form-control\" id=\"rad\"> ";
 echo" </div>    ";
  echo" <div class=\"form-group\"> ";
 echo"   <label for=\"celed\">Zadejte k jaké čeledi  ryba patří </label> ";
 echo"   <input type=\"text\"  name=\"celed\" class=\"form-control\" id=\"celed\"> ";
 echo" </div>    ";
    echo" <div class=\"form-group\"> ";
 echo"   <label for=\"zacatek\">Zadejte měsíc začátku doby hájení </label>  ";
 echo"   <input type=\"text\" name=\"zacatek\" class=\"form-control\" id=\"zacatek\"> ";
 echo" </div>    ";
 
 echo" <div class=\"form-group\"> ";
 echo"   <label for=\"konec\">Zadejte měsíc konce doby hájení </label>  ";
 echo"   <input type=\"text\" name=\"konec\" class=\"form-control\" id=\"konec\"> ";
 echo" </div>    ";
 
  echo" <div class=\"form-group\"> ";
 echo"   <label for=\"potrava\">Zadejt přirozenou potravu, kterou se daný druh ryby živí </label>  ";
 echo"   <input type=\"text\" name=\"potrava\" class=\"form-control\" id=\"potrava\"> ";
 echo" </div>    ";
 
   echo" <div class=\"form-group\"> ";
 echo"   <label for=\"navnada\">Zadejte vhodnou návnadu  </label>  ";
 echo"   <input type=\"text\" name=\"navnada\" class=\"form-control\" id=\"navnada\"> ";
 echo" </div>    ";

  echo" <div class=\"form-group\"> ";
 echo"   <label for=\"popis\">Zadejte popis ryby  </label>  ";
 echo"   <textarea class=\"form-control\" rows=\"5\" name=\"popis\" class=\"form-control\" id=\"popis\"> </textarea> ";
 echo" </div>    ";  
 
 
echo "<button type=\"submit\" name= \"tlacitko\" class=\"btn btn-primary\">Potvrď</button> ";
echo" </form>  ";
  echo "</div>";        
        
        
        
  echo "<div class=col-md-2 >";  
  echo "</div>";   
   echo "</div>";         
     
require_once("MySQL.php"); 
         if (isset($_REQUEST['tlacitko'])){
         if($_REQUEST['nazev'] <> "" and  $_REQUEST['rad'] <>"" and  $_REQUEST['celed'] <>"" and  $_REQUEST['zacatek'] <>""  and  $_REQUEST['konec'] <>""  and  $_REQUEST['potrava'] <>""  and  $_REQUEST['navnada'] <>""  and  $_REQUEST['popis'] <>""){       
                    $nazev= $_REQUEST['nazev'];
                		$rad= $_REQUEST['rad'];
                    $celed= $_REQUEST['celed'];
                    $zacatek = $_REQUEST['zacatek'];
                    $konec= $_REQUEST['konec'];
                    $potrava= $_REQUEST['potrava'];
                    $navnada= $_REQUEST['navnada'];
                    $popis= $_REQUEST['popis'];
                    
                    $prikaz="SELECT * from Druh";
                    $vysledek = $databaze->query($prikaz);
                    While($radek=$vysledek->fetch_object())
                  
                   {
                    
                      if($radek->nazev == $nazev){
                        echo "<br><div class=\"alert alert-danger\">Druh se stejným názvem již existuje</div> <br>" ;
                        exit();
                        }
                        
                  
                    }
                                    
                   $prikaz="INSERT into Druh VALUES('Null',?,?,?,?,?,?,?,?)";
                   $vysledek=$databaze->prepare($prikaz);
                	 $vysledek->bind_param("ssssssss",$nazev,$rad,$celed,$zacatek,$konec,$potrava,$navnada,$popis);
                	 $vysledek->execute();
                   echo "<br><div class=\"alert alert-success\">Druh byl úspěšně vložen.</div><br>";
                  
                   }  
           
               
         else{
           echo"<br> <div class='alert alert-danger'>Nezadal jste některý z údajů</div><br>";
         } 
         }
 
 
