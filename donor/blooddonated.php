<?php if(!isset($_SESSION)) {session_start();}  
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
	<head>
		<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
		<title>Blood Donated</title>
		<link href="css/lightbox.css" rel="stylesheet" />
		<link href="StyleSheet.css" rel="stylesheet" type="text/css" />
		<link href='http://fonts.googleapis.com/css?family=Source+Sans+Pro' rel='stylesheet' type='text/css'>
		<link href="css/style.css" rel="stylesheet" type="text/css" media="all" />
		<!--slider-->
		<link href="css/flexslider.css" rel="stylesheet" type="text/css" media="all" />
		<script src="js/jquery-1.11.0.min.js"></script>
		<script src="js/lightbox.min.js"></script>
		<script src="js/jquery-1.7.1.min.js" type="text/javascript"></script>
		<script src="js/jquery.flexslider.js" type="text/javascript"></script>
		<script type="text/javascript"
    src="jquery-ui-1.10.0/tests/jquery-1.9.0.js"></script>
<script src="jquery-ui-1.10.0/ui/jquery-ui.js"></script>

		<script type="text/javascript">
			$(function () {
			    SyntaxHighlighter.all();
			});
			$(window).load(function () {
			    $('.flexslider').flexslider({
			        animation: "slide",
			        animationLoop: false,
			        itemWidth: 210,
			        itemMargin: 5,
			        minItems: 2,
			        maxItems: 4,
			        start: function (slider) {
			            $('body').removeClass('loading');
			        }
			    });
			});
		</script>
	</head>
	<body>
		<?php
			if($_SESSION['donorstatus']=="")
			{
				header("location:../login.php");
			}
			?>
		<?php include('function.php'); ?>
		<div class="h_bg">
		<div class="wrap">
			<div class="header">
				<div class="wrap">
				</div>
			</div>
		</div>
		<div class="nav_bg">
		<div class="wrap">
			<?php require ('header.php'); ?>
		</div>
		<div style="height:400px; width:600px; margin:auto; margin-top:50px; margin-bottom:50px; background-color:#f8f1e4; border:2px solid red; box-shadow:4px 1px 20px black;">
			<form method="post" enctype="multipart/form-data">
				<table cellpadding="0" cellspacing="0" width="500px" class="tableborder" style="margin:auto" >
					<div class="p1" style="text-align: center;font-size: 40px; margin-top: 40px;color: red;">Blood Donated</div>
					<tr>
						<td>&nbsp;</td>
						<td>&nbsp;</td>
					</tr>
					<tr>
						<td class="lefttd">Select camp </td>
						<td>
							<select name="camp" required>
								<option value="">Select</option>
								<?php
									$cn=makeconnection();
									$s="SELECT * from camp where date <= date_add(CURRENT_DATE,INTERVAL 7 day) and date>=date_sub(CURRENT_DATE,INTERVAL 7 day)";
										$result=mysqli_query($cn,$s);
										$r=mysqli_num_rows($result);
										//echo $r;
										while($data=mysqli_fetch_array($result))
										{
											echo "<option value=$data[0]>$data[1]</option>";
										}
										mysqli_close($cn);
									
									?>
							</select>
							<tr>
						<td>&nbsp;</td>
						<td>&nbsp;</td>
					</tr>	<tr>
						<td>&nbsp;</td>
						<td>&nbsp;</td>
					</tr>
					<tr>
						<td class="lefttd"  style="vertical-align:middle">Blood Amount(in ml)</td>
						<td><input type="number" name="amount"  required="required" pattern="[0-9]{1,10}" placeholder="From 300 to 450ml" /></td>
					</tr>
					<tr>
						<td>&nbsp;</td>
						<td>&nbsp;</td>
					</tr>
				
					<tr>
						<td>&nbsp;</td>
						<td><input type="submit" value="Save" name="sbmt" style="border:0px; background:linear-gradient(#900,#D50000); width:100px; height:30px; border-radius:10px 1px 10px 1px; box-shadow:1px 1px 5px black; color:white; font-weight:bold; font-size:14px; text-shadow:1px 1px 6px black; "></td>
					</tr>
				</table>
				</table></td></tr>	</table>
			</form>
		</div>
		<?php
			if (isset($_POST["sbmt"])){
				
				if($_POST['amount']<300 || $_POST['amount']>450){
					echo "<script>alert('Amount of blood donated must be between 300-400ml');</script>";
				}
				else{
					$conn= makeconnection();
					if($conn->connect_error){
						die("Connection failed. ".$conn->connect_error);
					}

					$cn=makeconnection();
							
					$s="select id from donor where email='".$_SESSION['email']."'";
					$result=mysqli_query($conn,$s);
					$data3=mysqli_fetch_array($result);
					// $sql = "insert into donations(donor,camp,amount) values($data3['id'],$_POST['campid'],$_POST['amount'])";
					$donor=$data3['id'];
					// $campid=$_POST['campid'];
					$amount=$_POST['amount'];
					// $campid=$_POST['camp'];
					$sql = "insert into donations(donor,camp,amount) values(".$donor.",".$_POST['camp'].",".$amount.")";

					if($conn->query($sql))
						echo '<script>alert("Details saved!")</script>';
					// else
					// 	echo '<script>alert("'.$conn->error.'")</script>';
					
					$conn->close();
				}
              }
            
            
            ?> 
	</body>
</html>