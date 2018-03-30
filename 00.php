<meta charset="utf-8">
<?
require_once("MySQL.php"); 


if (isset($_REQUEST["id"]))
{

  $idc = $_REQUEST["id"];

	$prikaz = "SELECT Clanek.idClanek as id, Uzivatel.jmeno as jmeno, Clanek.nazev as nazev, Clanek.datum as datum, Clanek.text  
	FROM Clanek INNER JOIN Uzivatel WHERE Clanek.Uzivatel_idUzivatel = Uzivatel.idUzivatel and Clanek.idClanek= '$idc' ";

   
	$tabulka = $databaze->query($prikaz); 

	$row=$tabulka->fetch_object(); 
	
	
	echo "<div class=\"row\" >";
	echo "<div class=\"col-md-12\">";
 
     echo "<h3 style=background:black;color:white;height:30;padding:10px;>$row->nazev</h3>"; 
    
	 echo "</div>";
	 echo "</div>";
    
	echo "<div class=\"row\" >";
	echo "<div class=\"col-md-1\"></div>";
	echo "<div class=\"col-md-2\"><h4>";
   echo datum($row->datum);   
	 echo "</div></h4>";
	 echo "<div class=\"col-md-4\"><h4>";
	   echo $row->jmeno;   
	 echo "</h4></div>";
	 echo "</div>";
 

 
//	 echo "<hr>";

	echo "<div class=\"row\" >";
	echo "<div class=\"col-md-1\"></div>";
	echo "<div class=\"col-md-10\">";
   $nahled =  nl2br($row->text);
   echo $nahled;   
   
   
   echo "<br><br><br>";
    echo "<form> ";
    echo" <button type=\"submit\" name=\"tlacitko\" class=\"btn btn-primary\">Návrat zpět</button> ";
    echo "</form>";
	echo "<br><br><br>";
	
	 echo "</div>";
	 echo "</div>";




}
else
{


 
 if (isset($_POST["uziv"])) 
	$_SESSION["aktautor"]= $_POST["uziv"];

  if (isset($_POST["kslovo"])) 
  
	$_SESSION["aktklicslova"] = $_POST["kslovo"];

   
   
   echo "<br>";
 	echo "<div class=\"row\" >";
	echo "<div class=\"col-md-1\">";
	
    echo "<form name=prvni method=\"post\" action=\"index.php\"> ";
	echo "<input type=hidden name=zacatek value=1>";
    echo" <button type=\"submit\" name=\"tlacitko\" class=\"btn btn-primary\">Začátek</button> ";
    echo "</form>";
	
    echo "</div>";
	echo "<div class=\"col-md-1\">";
	
    echo "<form name=vzad method=\"post\" action=\"index.php\"> ";
	echo "<input type=hidden name=vzad value=1>";
    echo" <button type=\"submit\" name=\"tlacitko\" class=\"btn btn-primary\">Zpět</button> ";
    echo "</form>";
	
    echo "</div>";
	
	echo "<div class=\"col-md-1\"><h4>Autor:</h4></div>";
	echo "<div class=\"col-md-2\">";
	
	$prikaz = "SELECT * from Uzivatel ";
	$tabulka = $databaze->query($prikaz); 
	echo "<h4>";
    echo "<form name = \"podleuz\" method = \"post\" action = \"\">";
    echo "<select name=\"uziv\" size=1  onchange=self.document.forms.podleuz.submit() >";
	
	     echo "<option value = \"\">";
         echo "</option>";
		 
	while($row=$tabulka->fetch_object()) {
		
	        echo "<option value = " .$row->idUzivatel;
			if ($row->idUzivatel == $_SESSION["aktautor"]) echo " selected ";
			echo ">";
			echo $row->jmeno;
	        echo "</option>";
   
	}			 
   	 echo "</select>";	
	 echo "</form>";
	echo "</h4>";	


	
	
	echo "</div>";
	echo "<div class=\"col-md-1\"><h4>Klíč.slova</h4></div>";
	echo "<div class=\"col-md-4\">";
	
	echo "<h4>";
    echo "<form name=klicslovo method=\"post\" action=\"index.php\"> ";
	echo "<input type=text name=kslovo size=20 value=\"" .$_SESSION["aktklicslova"] ."\" onchange=self.document.forms.klicslovo.submit()>";
    echo "</form>";
	echo "</h4>";
	
    echo "</div>";

	echo "<div class=\"col-md-1\">";
	
    echo "<form name=vpred method=\"post\" action=\"index.php\"> ";
	echo "<input type=hidden name=vpred value=1>";
    echo" <button type=\"submit\" name=\"tlacitko\" class=\"btn btn-primary\">Vpřed</button> ";
    echo "</form>";
	
    echo "</div>";


 echo "</div>";
 echo "<br>";
	
	
 if (isset($_POST["zacatek"])) 
      $_SESSION["aktpozice"]=0;
 if (isset($_POST["vzad"])) 
 {
      $_SESSION["aktpozice"]= $_SESSION["aktpozice"] - 4;
	  if ($_SESSION["aktpozice"]<1)  $_SESSION["aktpozice"]=0;
 }
 if (isset($_POST["vpred"])) 
 {
      $_SESSION["aktpozice"]= $_SESSION["aktpozice"] + 4;
 }
 
$iduz = $_SESSION["aktautor"];
$od = $_SESSION["aktpozice"];


	
$prikaz = "SELECT Clanek.idClanek as id, Uzivatel.jmeno as jmeno, Clanek.nazev as nazev, Clanek.datum as datum, Clanek.text  
	FROM Clanek INNER JOIN Uzivatel WHERE Clanek.Uzivatel_idUzivatel = Uzivatel.idUzivatel ";
	
if ($iduz <> "")
	$prikaz .=" and Clanek.Uzivatel_idUzivatel = '$iduz' ";
	

if ($_SESSION["aktklicslova"]<> "")
{
 $slova = $_SESSION["aktklicslova"];
 $slovo = "";
 for ($i = 0;$i<strlen($slova); $i++)
 {
	 if ($slova[$i]<> " ")
		 $slovo .= $slova[$i];
	 else
	 {
		$prikaz .=" and Clanek.text LIKE '%" .$slovo .="%' ";
		$slovo = "";
	 }
 }
 $prikaz .=" and Clanek.text LIKE '%" .$slovo .="%' ";
}	

$tabulka = $databaze->query($prikaz); 
$pocet = $tabulka->num_rows;

if ($pocet < $od)
{
	 $_SESSION["aktpozice"] = 0;
	 $od = 0;
}

$prikaz .=" ORDER BY Clanek.datum DESC  LIMIT  $od,4";

$tabulka = $databaze->query($prikaz); 

//echo $prikaz ."<br>";


while($row=$tabulka->fetch_object()) {


echo "<div class=\"row\" >";
echo "<div class=\"col-md-12\">";
 
     echo "<a href=index.php?id=" .$row->id ." style=cursor:pointer;>";
     echo "<h3 style=background:black;color:white;height:30;padding:10px;>$row->nazev</h3>"; 
   echo "</a>"; 
    
 echo "</div>";
 echo "</div>";
    
echo "<div class=\"row\" >";
echo "<div class=\"col-md-1\"></div>";
echo "<div class=\"col-md-2\"><h4>";
   echo datum($row->datum);   
 echo "</div></h4>";
 echo "<div class=\"col-md-4\"><h4>";
   echo $row->jmeno;   
 echo "</h4></div>";
 echo "</div>";
 
// echo "<hr>";

echo "<div class=\"row\" >";
echo "<div class=\"col-md-1\"></div>";
echo "<div class=\"col-md-10\">";
   $nahled = substr($row->text,0,420);
   echo $nahled;   
 echo "</div>";
 echo "</div>";
  
    
}
}


function datum($d)
{
	$datum1 = substr($d,8,2);
	$datum1 .= ".";
	$datum1 .= substr($d,5,2);
	$datum1 .= ".";
	$datum1 .= substr($d,0,4);
   return $datum1;	
}



?>