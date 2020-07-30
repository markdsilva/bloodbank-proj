<?php if(!isset($_SESSION)) {session_start();}  ?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Add admin</title>
<link href="StyleSheet.css" rel="stylesheet" type="text/css" />
<link href='http://fonts.googleapis.com/css?family=Source+Sans+Pro' rel='stylesheet' type='text/css'>
<link href="css/style.css" rel="stylesheet" type="text/css" media="all" />
<!--slider-->
<link href="css/flexslider.css" rel="stylesheet" type="text/css" media="all" />
<script src="js/jquery-1.7.1.min.js" type="text/javascript"></script>
<script src="js/jquery.flexslider.js" type="text/javascript"></script>
 
</head>
<body>

<?php
if($_SESSION["loginstatus"]=="")
{
	header("location:adminlogin.php");
}
?>
<?php include('topbar.php'); ?>
    <center>
   <div style="width:1000px; height:700px; box-shadow:-10px 10px 5px #CCC">
       <div style="width:200px; float:left;">
       <?php include('left.php'); ?>
       </div>
       <div style="width:800px;float:left">
<br /><br />

<?php include('function.php'); ?>


       <form method="post">
<table border="0" align="center" width="400" height="300px" class="shaddoww">
<tr><td colspan="2" align="center" class="toptd">Add User</td></tr>
<tr><td colspan="2">&nbsp;</td></tr>
<tr><td class="lefttd">User Name</td><td><input type="text" name="username" required="required" pattern="[a-zA-Z _]{3,15}" title="please enter only character between 3 to 15 for user name"/></td></tr>
<tr><td class="lefttd">Password</td><td><input type="password" name="password"  required="required" pattern="[a-zA-Z0-9]{3,10}" title="please enter only character and numbers between 3 to 10 for password" /></td></tr>

</select></td></tr>
<tr><td>&nbsp;</td><td><input type="submit" value="SAVE" name="sbmt"></td></tr>
</table>
</form>
<?php include('viewusers.php'); ?>

       </div>
      


   </div>
    </center>
    <?php
if (isset($_POST["sbmt"])){
				
    $conn= makeconnection();
    
    if($conn->connect_error){
    die("Connection failed. ".$conn->connect_error);
    }

    $sql = "insert into user(username,pwd) values('" . $_POST["username"] ."','" . $_POST["password"]."')";"";

    if($conn->query($sql))
    echo '<script>alert("New Admin added!")</script>';
    else
    echo '<script>alert("Error!")</script>';
    
    $conn->close();

}
?>

</body>



</html>