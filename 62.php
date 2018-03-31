                                
 <?php

 echo "<div class=row>";
 
 
 if ($_SESSION['login']== false)
 {
  echo "<div class=\"alert alert-danger\">";
  echo "Pro práci se rybami musíte být přihlášen. Přihlaste se prosím";
  echo "</div>";
  exit;
  
 }

    // id je id radku v tabulce k editaci
  if (isset($_REQUEST["id"]))
      $id = $_REQUEST["id"];
  else
  {
    echo "chybné volání stránky bez id";
    exit;  
   }
  
   echo "<div class=col-md-5>"; 
  	 
	if (isset($_FILES["file"]["name"]))
  {
	 $pozice = 0;
	
	 for ($i=strlen($_FILES["file"]["name"]);$i > 1; $i--)
	 {
		 if (substr($_FILES["file"]["name"],$i,1) == "." ) $pozice = strlen($_FILES["file"]["name"])- $i;
	 }
 
	
	 
   $pozice = ($pozice) * -1 ;
	 $ext =substr($_FILES["file"]["name"], $pozice); 
	 
	  
	 $dir = "obr/ryba/";  
 	 
	 $jmeno = $id;
	 $jmeno .=$ext;  
   
   
    if (is_file("$dir$id.jpg"))  unlink("$dir$id.jpg");
    if (is_file("$dir$id.jpeg")) unlink("$dir$id.jpeg");
    if (is_file("$dir$id.bmp"))  unlink("$dir$id.bmp");
    if (is_file("$dir$id.png"))  unlink("$dir$id.png");
    
	 if ($ext == ".jpg" or $ext == ".bmp" or $ext == ".jpeg" or $ext == ".png" )
  	 move_uploaded_file($_FILES['file']['tmp_name'],$dir.$jmeno);
   else
    {
      echo "<div class=\"alert alert-danger\">";
      echo "Tento typ souboru nelze nahrát";
      echo "</div>";
    } 
	 }
  
 
   
  echo "<br>";
  $jm = "obr/ryba/";
  $jm .=$id;
   
  if (is_file("$jm.jpg"))
      echo "<img src=$jm.jpg width=400>";
  if (is_file("$jm.bmp"))
      echo "<img src=$jm.bmp width=400>";
  if (is_file("$jm.png"))
      echo "<img src=$jm.png width=400>";
  if (is_file("$jm.jpeg"))
      echo "<img src=$jm.jpeg width=400>";                  
  
  echo "<br><br><br>";    
  echo "<form method = \"post\" enctype=\"multipart/form-data\">";  
	 	 echo "<input type=\"file\"  name=\"file\" size=\"60\"><br>";
      echo" <button type=\"submit\" name=\"tlacitko\" class=\"btn btn-primary\">Nahrát obr</button> ";  
	echo "</form>"; 


  	   
      
  echo "</div>";
  
 
  
  require("../CONNECT/CONNECT.php");  
  $databaze=new mysqli($host, $user, $password, $db) or die("connect ERROR");
   $databaze->set_charset("utf8");
  if ($databaze->connect_errno){
    printf("Pripojeni spadlo: %s\n", $databaze->connect_error);
    exit();
  }   
  
   $sql="SELECT * FROM Druh WHERE idDruh = '".$id."'";
   $vysledek = mysqli_query($databaze,$sql);
   $radek= mysqli_fetch_array($vysledek); 
 
       

  echo "<div class=col-md-5 >";  

 echo "<form > ";
echo "<input type=hidden name=id1 value= $id>"; 
 echo" <div class=\"form-group\"> ";
 echo"   <label for=\"nazev\">Zadejte název druhu ryby </label>  ";
 echo"   <input type=\"text\" name=\"nazev\" class=\"form-control\" id=\"nazev\"  value=\"" .$radek['nazev'] ."\">  ";
 echo" </div>  ";
 echo" <div class=\"form-group\"> ";
 echo"   <label for=\"rad\">Zadejte k jakému řádu ryba patří </label>  ";
 echo"   <input type=\"text\" name=\"rad\" class=\"form-control\" id=\"rad\" value=\"" .$radek['rad'] ."\">";
 echo" </div>    ";
  echo" <div class=\"form-group\"> ";
 echo"   <label for=\"celed\">Zadejte k jaké čeledi  ryba patří </label> ";
 echo"   <input type=\"text\"  name=\"celed\" class=\"form-control\" id=\"celed\" value=\"" .$radek['celed'] ."\">";
 echo" </div>    ";
    echo" <div class=\"form-group\"> ";
 echo"   <label for=\"zacatek\">Zadejte měsíc začátku doby hájení </label>  ";
 echo"   <input type=\"text\" name=\"zacatek\" class=\"form-control\" id=\"zacatek\" value=\"" .$radek['zacatek_hajeni'] ."\">";
 echo" </div>    ";
 
 echo" <div class=\"form-group\"> ";
 echo"   <label for=\"konec\">Zadejte měsíc konce doby hájení </label>  ";
 echo"   <input type=\"text\" name=\"konec\" class=\"form-control\" id=\"konec\" value=\"" .$radek['konec_hajeni'] ."\">";
 echo" </div>    ";
 
  echo" <div class=\"form-group\"> ";
 echo"   <label for=\"potrava\">Zadejt přirozenou potravu, kterou se daný druh ryby živí </label>  ";
 echo"   <input type=\"text\" name=\"potrava\" class=\"form-control\" id=\"potrava\" value=\"" .$radek['potrava'] ."\">";
 echo" </div>    ";
 
   echo" <div class=\"form-group\"> ";
 echo"   <label for=\"navnada\">Zadejte vhodnou návnadu  </label>  ";
 echo"   <input type=\"text\" name=\"navnada\" class=\"form-control\" id=\"navnada\" value=\"" .$radek['navnada'] ."\">";
 echo" </div>    ";

  echo" <div class=\"form-group\"> ";
 echo"   <label for=\"popis\">Zadejte popis ryby  </label>  ";
 echo"   <textarea class=\"form-control\" rows=\"5\" name=\"popis\" class=\"form-control\" id=\"popis\"> ".$radek['popis']."</textarea> ";
 echo" </div>    ";
      
     
        
require("../CONNECT/CONNECT.php");  
  $databaze=new mysqli($host, $user, $password, $db) or die("connect ERROR");
   $databaze->set_charset("utf8");
  if ($databaze->connect_errno){
    printf("Pripojeni spadlo: %s\n", $databaze->connect_error);
    exit();
  }     
      
       
 				 
 
 echo" <button type=\"submit\" name=\"tlacitko\" class=\"btn btn-primary\">Potvrď</button> ";
echo" </form>  ";
  echo "</div>";        
        
        
        
  echo "<div class=col-md-2 >";  
  echo "</div>";   
   echo "</div>";         
        
      
 
        
        
    
    
    echo "<br><br>";
    echo "<form action=index.php?s=10>";
    echo" <button type=\"submit\" name=\"tlacitko\" class=\"btn btn-primary\">Návrat zpět</button> ";
    echo "</form>";
    
    
    

 