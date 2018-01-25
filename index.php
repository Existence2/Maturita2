<!DOCTYPE html>
<html lang="en">
<head>
  <title>Bootstrap</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.0/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
</head>
<body>



<nav class="navbar navbar-inverse">
  <div class="container-fluid">
    <ul class="nav navbar-nav">
      <li class="active"><a href="index.php?s=0">Home</a></li>
      <li><a href="index.php?s=1">A</a></li>
      <li><a href="index.php?s=2">B</a></li>
      <li><a href="index.php?s=3">C</a></li>
    </ul>
  </div>
</nav>

<?php
  session_start();
  
  if (!isset($_SESSION["strana"]))    $_SESSION["strana"]=0; 
  if (!isset($_SESSION["login"]))     $_SESSION["login"]=false; 
  if (isset($_REQUEST["s"]))
             $_SESSION["strana"] =$_REQUEST["s"];  
             
  if ($_SESSION["login"]==false)    { $_SESSION["strana"]=0; echo "neprihlasen";}
  if ($_SESSION["login"]==true)     echo  "prihlasen";
  
  if (isset($_REQUEST["email"])) prihlaseni();
   
   switch ($_SESSION["strana"])
   {
    case "0": strana0(); break;   
    case "1": strana1(); break;
    case "2": strana2(); break;
    case "3": strana3(); break;  
    }
    
 
 ?>        
       
</div>

</body>
</html>


<?php 

function prihlaseni()
{
  $email =   $_REQUEST["email"];
  $pwd =     $_REQUEST["pwd"];
  if ($pwd == "12345")
  { 
   $_SESSION["login"]=true;
   echo '
    <div class="alert alert-success">
    <strong>Success!</strong>Byl jste prihlasen.
    </div> 
    ';
    $_SESSION["strana"]=1;
  }
  else
  { 
   echo '
    <div class="alert alert-danger">
    <strong>UnSuccess!</strong>NEBYL jste prihlasen.
    </div> 
    ';
  }
  
  
}

function strana0()
 {
  echo '
  <div class="row">
   <div class="col-sm-7">
      
   </div>
   <div class="col-sm-4">
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
    <label><input type="checkbox"> Zapamatovat </label>
  </div>
  <button type="submit" class="btn btn-default">Přihlásit</button>
   </form>
   </div>
   
   </div>
  </div>
 </div>
 
   
  </div> 
  '; 
  
 }  
   
 function strana1()
 {
 echo '
  <div class="row">
   <div class="col-sm-12">
    <div class="alert alert-warning">
      Test.
    </div>
   </div>
  </div> 
  '; 
 }
  
 function strana2()
 {
 }            
 
 function strana3()
 {
 }
?>