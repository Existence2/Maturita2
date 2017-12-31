 <html>
<head>
<script>
function showState(str) {
    if (str == "") {
        document.getElementById("txtHint").innerHTML = "";
        return;
    } else {
        if (window.XMLHttpRequest) {
          xmlhttp = new XMLHttpRequest();
        } 
        xmlhttp.onreadystatechange = function() {
            if (this.readyState == 4 && this.status == 200) {
                document.getElementById("txtHint").innerHTML = this.responseText;
            }
        };
        xmlhttp.open("GET","getfish.php?q="+str,true);
        xmlhttp.send();
    }
}
</script>
</head>
<body>

<form>
<select name="states" onChange="showState(this.value)">
 <option value="">Select a fish</option>
  
<?php
  require("../CONNECT/CONNECT.php"); 
  $databaze=new mysqli($host, $user, $password, $db) or die("connect ERROR");
  $databaze->set_charset("utf8");
  if ($databaze->connect_errno){
  printf("Pripojeni spadlo: %s\n", $databaze->connect_error);
       exit();
            }

mysqli_select_db($databaze,"Druh");
$sql="SELECT * from Druh group by nazev";
$result = mysqli_query($databaze,$sql);
  
while($row = mysqli_fetch_array($result)) {
  ?>
   <option value= "<?php echo $row['nazev'] ?>"><?php echo $row['nazev'] ?></option>
    <?php
}  
 ?>
</select>
</form>
<br>
<div id="txtHint"><b>Zde budou ryby</b></div>

</body>
</html> 
