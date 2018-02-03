
 <?php
 $t1 = "Prihlaste se prosím";
	   $t2 = "Heslo";
	   $t4 = "Přihlásit";
	   $t5 = "Jméno";
   
   
	 
	 
   echo "<div class=\"panel panel-primary\">";
	echo "<div class=\"panel-heading\"> ";
	echo "<h3 class=\"panel-title\">$t1</h3>";
	echo "</div>";
	echo "<div class=\"panel-body\"> ";
	echo "<form role\"form\" method=post >";

	 echo "<div class=\"form-group\"> ";
	  echo "<label for=\"jmeno\">Jméno</label>";
	  echo "<input type=\"text\" class=\"form-control\" id=\"jmeno\" name=\"jmeno\"   placeholder=\"$t5\"> ";
     echo "</div>";
	 echo "<div class=\"form-group\">";
	  echo "<label for=\"heslo\">$t2</label>";
	  echo "<input type=\"password\" class=\"form-control\" id=\"heslo\" name=\"heslo\" placeholder=\"$t2\">";
	 echo "</div>";
	 echo "<button type=\"submit\" name= \"prihlasit\" class=\"btn btn-primary\">$t4</button> ";
	 echo "</form>";
	echo "</div>";
   echo "</div>";
  
  
require("../CONNECT/CONNECT.php"); 
  
  $databaze=new mysqli($host, $user, $password, $db) or die("connect ERROR");
  $databaze->set_charset("utf8");
  if ($databaze->connect_errno){
    printf("Pripojeni spadlo: %s\n", $databaze->connect_error);
    exit();
  }


if (isset($_REQUEST['prihlasit'])){

  if($_REQUEST['heslo'] <> "" and  $_REQUEST['jmeno'] <>"")
   {$jmeno=$_REQUEST["jmeno"];
    $heslo=$_REQUEST["heslo"];
    $heslo=md5($heslo);
    $prikaz = "SELECT idUzivatel, jmeno, heslo FROM Uzivatel WHERE jmeno = '$jmeno' AND heslo = '$heslo'";
    $tabulka=$databaze->query($prikaz);
    if ($tabulka->num_rows==0)
   {  $id_uzivatele=" ";
   echo "Musíte se registrovat";}
    
    
     While($radek=$tabulka->fetch_object())
   {
    echo"$radek->jmeno, jste úspěšně přihlášen.";
     $id_uzivatele=$radek->idUzivatel;
   }


  $_SESSION['jmeno']="$jmeno";
  $_SESSION['id']=$id_uzivatele; 
  $_SESSION['login']=true;
 
  if ($id_uzivatele=" "){
  $_SESSION['id']==" ";
    }
  
  }
  else {
    echo "Jméno a heslo nebylo zadané, přihlášení neproběhlo<br><br>";
    exit;
   }

  
 
            
}  
  
/*function prihlaseni($a, $b){
    
  if($a <> "" and  $b <>"")
   {$jmeno=$a;
    $heslo=$b;
    $heslo=md5($heslo);
    $prikaz = "SELECT idUzivatel, jmeno, heslo FROM Uzivatel WHERE jmeno = '$jmeno' AND heslo = '$heslo'";
    $tabulka=$databaze->query($prikaz);
    if ($tabulka->num_rows==0)
   {  $id_uzivatele=" ";
   echo "Musíte se registrovat";}
    
    
     While($radek=$tabulka->fetch_object())
   {
    echo"$radek->jmeno, jste úspěšně přihlášen.";
     $id_uzivatele=$radek->idUzivatel;
   }


  $_SESSION['jmeno']="$jmeno";
  $_SESSION['id']=$id_uzivatele; 
  $_SESSION['login']=true;
 
  if ($id_uzivatele=" "){
  $_SESSION['id']==" ";
    }
  
  }
  else {
    echo "Jméno a heslo nebylo zadané, přihlášení neproběhlo<br><br>";
    exit;
   }

  

} */
 
  
  
  
 ?> 

   <!--
  <div class="row">
  <div class="col-sm-7">
     <img src="kapr_obecny.gif" alt="kapr_obecny.gif" title="Kapr obecny" height="242" width="519">
   </div> 
   <div class="col-sm-">
   <br>
   
  <div class="panel-group">
  <div class="panel panel-primary">
    <div class="panel-body">Přihlášení</div>
  </div>
  <div class="panel panel-primary">
  <div class="panel-body">
   
   <form>
   <div class="form-group">
    <label for="email">Email address:</label>
    <input type="email" class="form-control" name="email"  id="email">
  </div>
  <div class="form-group">
    <label for="pwd">Password:</label>
    <input type="password" class="form-control" name="pwd" id="pwd">
  </div>
  <div class="checkbox">
    <label><input type="checkbox"> Remember me</label>
  </div>
  <button type="submit" class="btn btn-default">Submit</button>
   </form>
   </div>
   
   </div>
  </div>
 </div>
 
   
  </div> 
     -->