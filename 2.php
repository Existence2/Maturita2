
 <div class="panel-group">
 <div class="panel panel-primary">
   <div class="panel-body">Registrace</div>
 </div>
 <div class="panel panel-primary">
 <div class="panel-body">

  <form>
  <div class="form-group">
   <label for="jmeno">Uživatelské jméno</label>
   <input type="text" class="form-control" name="jmeno"  id="jmeno">
 </div>

 <div class="form-group">
   <label for="heslo">Heslo:</label>
   <input type="password" class="form-control" name="heslo" id="heslo">
 </div>
 <div class="form-group">
   <label for="reheslo">Znovu heslo:</label>
   <input type="password" class="form-control" name="reheslo" id="reheslo">
 </div>
 </div>
 <button type="submit" name="registrace" class="btn btn-default">Potvrd</button>
  </form>
  </div>

  </div>
 </div>
</div>


 </div>


<?php

require("../CONNECT/CONNECT.php");



 $databaze=new mysqli($host, $user, $password, $db) or die("connect ERROR");
 if ($databaze->connect_errno){
   printf("Připojení spadlo: %s\n", $databaze->connect_error);
   exit();
 }

if (isset($_REQUEST['registrace']))
{

 if($_REQUEST['heslo'] <> "" and  $_REQUEST['jmeno'] <>""){

   $jmeno= $_REQUEST['jmeno'];
   $heslo= $_REQUEST['heslo'];
   $reheslo= $_REQUEST['reheslo'];
   $pravo= 1;

   $prikaz="SELECT * from Uzivatel";
   $vysledek = $databaze->query($prikaz);
  While($radek=$vysledek->fetch_object())

  {

   if($radek->jmeno ==$jmeno ){
     echo "Toto jméno je již obsazené, zvolte prosím jiné. " ;
     exit();
     }

   if ($heslo != $reheslo ){
    echo "Vaše heslo se neshoduje " ;
     exit();
  }
  }
   $heslo=md5($heslo);
   $prikaz="INSERT into Uzivatel VALUES('Null',?,?,?)";
   $vysledek=$databaze->prepare($prikaz);
   $vysledek->bind_param("ssi",$jmeno,$heslo,$pravo);
   $vysledek->execute();
   echo '<div class="alert alert-success">
 <strong>Success!</strong> Váš účet byl vytvořen </div>';
   }
  else
       echo"Jméno a heslo nebylo zadané, registrace neproběhla<br><br>";

}


/* echo" <div class=\"panel-group\">   " ;
echo"  <div class=\"panel panel-primary\">   " ;
 echo"     <div class=\"panel-body\">Registrace</div>  " ;
echo"  </div>   ";
echo"  <div class=\"panel panel-primary\">  ";
echo"  <div class=\"panel-body\">  ";

echo"   <form>   ";
echo"    <div class=\"form-group\">   ";
echo"     <label for=\"jmeno\">Uživatelské jméno</label>  ";
echo"     <input type=\"text\" class=\"form-control\" name=\"jmeno\"  id=\"jmeno\">    ";
echo"   </div>  ";

echo"   <div class=\"form-group\">   ";
echo"     <label for=\"heslo\">Heslo:</label>    ";
echo"     <input type=\"password\" class=\"form-control\" name=\"heslo\" id=\"heslo\">   ";
echo"   </div>            ";
echo"   <div class=\"form-group\">      ";
echo"     <label for=\"reheslo\">Znovu heslo:</label>       " ;
echo"     <input type=\"password\" class=\"form-control\" name=\"reheslo\" id=\"reheslo\">    ";
echo"   </div>    ";
echo"   </div>   ";
echo"   <button type=\"submit\" name=\"registrace\" class=\"btn btn-default\">Potvrd</button>      " ;
echo"    </form> ";
echo"    </div>   ";

echo"    </div>  " ;
echo"   </div>    " ;
echo"  </div>   ";


echo"  </div>  ";

 */
?>
