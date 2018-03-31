  <meta charset="utf-8">                                
 <?php
     if($_SESSION["login"]==true){
     
 echo "<div class=row>";
 
  echo "<div class=col-md-2 >";  
  echo "</div>";
  
  
  echo "<div class=col-md-8 >";  

 echo "<form role\"form\" method=post >";    
 echo" <div class=\"form-group\"> ";
 echo"   <label for=\"nazev\">Zadejte nadpis článku </label>  ";
 echo"   <input type=\"text\" name=\"nazev\" class=\"form-control\" id=\"nazev\">  ";
 echo" </div>  ";

  echo" <div class=\"form-group\"> ";
 echo"   <label for=\"text\">Zadejte obsah článku  </label>  ";
 echo"   <textarea class=\"form-control\" rows=\"25\" name=\"text\" class=\"form-control\" id=\"text\"> </textarea> ";
 echo" </div>    ";

 
echo "<button type=\"submit\" name= \"tlacitko\" class=\"btn btn-primary\">Potvrd</button> ";
echo" </form>  ";
  echo "</div>";        
                                     
        
        
  echo "<div class=col-md-2 >";  
  echo "</div>";   
   echo "</div>";         
 
 echo "<br>";
  echo "<div class=row>";
  echo "<div class=col-md-2 >";  
  echo "</div>";
  
  
  echo "<div class=col-md-8 >";  

 
          require_once("MySQL.php"); 
           if (isset($_REQUEST['tlacitko'])){
           if($_POST['nazev'] <>"" AND  $_POST['text'] <>""){       
                      $nazev= htmlentities($_POST['nazev']);
                      $text= htmlentities($_POST['text']);
                      $datum= date('Y-m-d');
                      $id_uzivatele= $_SESSION['id'];
                      $prikaz="SELECT * from Clanek";
                      $vysledek = $databaze->query($prikaz);
                      While($radek=$vysledek->fetch_object())
                    
                     {
                      
                         if($radek->nazev == $nazev and $radek->text == $text){
                           echo "<div class=\"alert alert-warning\">Článek se stejným nadpisem a názvem již existuje </div>" ;
                          exit();
                          }
                      
                        if($radek->nazev == $nazev){
			              echo "<div class=\"alert alert-warning\">Článek se stejným nadpisem již existuje </div>" ;

                          exit();
                          }
                          
                        if($radek->text == $text){
			              echo "<div class=\"alert alert-warning\">Článek se stejným textem již existuje </div>" ;
                          exit();
                          }
                        
                    }
                    
       
                    
                 
                 $prikaz = "INSERT into Clanek(idClanek,nazev,text,Uzivatel_idUzivatel, datum) VALUES('Null','$nazev','$text',$id_uzivatele,'$datum')";
                  if(mysqli_query($databaze, $prikaz)) {
                                 echo "<div class=\"alert alert-success\">Článek byl úspěšně uložen</div>";
                      } else {
                            echo "Error: " . $prikaz . "<br>" . mysqli_error($databaze);
                      } 
                   }
                              
         else{
           echo("nezadal jste některý z údajů");
         }
          
      }
   }      
        
  echo "<div class=col-md-2 >";  
  echo "</div>";   
   echo "</div>";                  
      
  if($_SESSION["login"]==false){
    echo "Nejste přihlášený";
    exit();
    
    }
   
