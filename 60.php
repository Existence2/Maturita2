                                
 <?php

 echo "<div class=row>";
 
  if($_SESSION['login']==false){
     echo "<div class=col-md-5>"; 
      echo "Nejste přihlášený";
      exit();
    }
  
  if (isset($_REQUEST["id"]))
      $id = $_REQUEST["id"];
  else
  {
   echo "<div class=\"alert alert-danger\">";
  echo "Chybné volání stránky bez id";
  echo "</div>";
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
	 
	  
	 $dir = "obr/ulovky/";  
 	 
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
  $jm = "obr/ulovky/";
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
  
 
require_once("MySQL.php"); 
  
   $sql="SELECT * FROM Ulovek WHERE idUlovek = '".$id."'";
   $vysledek = mysqli_query($databaze,$sql);
   $radek= mysqli_fetch_array($vysledek); 
 
       
    
  
  echo "<div class=col-md-5 >";  

  echo"   <form>   ";
  echo "<input type=hidden name=id1 value= $id>";    
 echo" <div class=\"form-group\"> ";
 echo"   <label for=\"rozmer\">Zadejte rozměr vašeho úlovku (cm)</label>  ";
  echo"   <input type=\"number\" class=\"form-control\" name=\"rozmer\" id=\"rozmer\" value=\"" .$radek['rozmer'] ."\">  ";
  echo" </div>  ";
 echo" <div class=\"form-group\"> ";
 echo"   <label for=\"vaha\">Zadejte váhu vašeho úlovku v kg (dvě desetinná místa) </label>  ";
 echo"   <input type=\"number\" class=\"form-control\" name=\"vaha\" id=\"vaha\" value=\"" .$radek['vaha'] ."\">  ";
 echo" </div>    ";
  echo" <div class=\"form-group\"> ";
 echo"   <label for=\"datum\">Zadejte datum vašeho úlovku</label>  ";
 echo"   <input type=\"date\" class=\"form-control\" name=\"datum\" id=\"datum\" value=\"" .$radek['datum'] ."\">  ";
 echo" </div>    ";

    echo" <div class=\"form-group\"> ";
 echo"   <label for=\"lov\">Zadejte způsob lovu vašeho úlovku</label>  ";
 echo"   <input type=\"text\" class=\"form-control\"  name=\"lov\" id=\"lov\" value=\"" .$radek['zpusob_lovu'] ."\">  ";
 echo" </div>    ";
 
     
    echo" <div class=\"form-group\"> ";
 echo"   <label for=\"ryba\">Vyberte rybu </label>  ";
 	
		echo "<select name=\"ryba\" id=\"ryba\" class=\"form-control\" size=1 >";
     

$prikaz = "SELECT idDruh, nazev  FROM Druh ";
$tabulka=$databaze->query($prikaz); 
 if ($tabulka->num_rows==0)
   {  
   echo "Je nutné vložit do sytému aspon 1 druh ryby";
   exit();}
    
    
     While($radek1=$tabulka->fetch_object())
   {
             
           echo "<option value = '";
           $druh=$radek1->idDruh; 
            echo $druh;
            if ($radek1->idDruh == $radek['Druh_idDruh'] ) 
              echo "' selected >";
            else  
              echo "' >";
            echo $radek1->nazev;
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
   echo "Je nutné vložit do sytému aspoň 1 druh ryby";
   exit();}
 
    
    While($radek2=$tabulka->fetch_object())
   {
             
           echo "<option value = '";
             $revir=$radek2->idRevir;
             echo $revir;
            if ($radek2->idRevir == $radek['Revir_idRevir'] ) 
              echo "' selected >";
            else  
              echo "' >"; 
            
            echo $radek2->nazev;
            
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
        

    
    echo "<br><br>";
    echo "<form action=index.php?s=5>";
    echo" <button type=\"submit\" name=\"tlacitko\" class=\"btn btn-primary\">Návrat zpět</button> ";
    echo "</form>";
    
    
    
