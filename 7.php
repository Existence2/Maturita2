<?php

session_destroy();
$_SESSION['login']==false;
   if($_SESSION['login']==true) echo"přihlášen";
    if($_SESSION['login']==false) echo"nepřihlášen";


?>

 <script>
window.location.href="http://student.sspbrno.cz/~koch.michael/MP/novy.php?s=3";
</script>