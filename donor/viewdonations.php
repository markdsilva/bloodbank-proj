<?php if(!isset($_SESSION)) {session_start();}  ?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
	<head>
		<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
		<title>View Donations</title>
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
				</div>
			</div>
		</div>
		<div class="nav_bg">
		<div class="wrap">
			<?php require ('header.php'); ?>
		</div>
		<!-- <div style="height:300px; width:800px; margin:auto; margin-top:50px; margin-bottom:50px; background-color:#f8f1e4; border:2px solid red; box-shadow:4px 1px 20px black;"> -->
			<form method="post" enctype="multipart/form-data">
            <style>td{
                            border: 1px solid #808080;
                            padding: 5px;
                        }</style>
            	<table cellspacing="0" cellpadding="0" width="800px" style="margin:auto" class="tableborder" >
					<tr>
                    <div class="p1" style="text-align: center;font-size: 40px; margin-top: 40px;color: red;">Your Donations</div>
					</tr>
					<tr>
						&nbsp;
					</tr>
					<tr style="background-color:bisque" align="center" class="bold">
                        <td>Sr. No.</td>
                        <td>Camp Name</td>
						<td>Date of Donation</td>
						<td>Amount (ml)</td>
					</tr>
					<tr>
					&nbsp;
					</tr>
					<?php
						$cn=makeconnection();
						$sql="select donor.id from donor where email='". $_SESSION["email"] . "'";
						$result1=mysqli_query($cn,$sql);
						$data=mysqli_fetch_array($result1);
						$donorid=$data['id'];
						
						$s="select camp.name as campname,Date_format(camp.date, '%d/%m/%Y')  as campdate,donations.amount as amount from camp,donations where camp.id=donations.camp and donations.donor=".$donorid;
							$result=mysqli_query($cn,$s);
							// $r=mysqli_num_rows($result);
                            //echo $r;
                            $i=1;
							while($data=mysqli_fetch_array($result))
							{
						        echo"
						        <tr>
						            <td  style=' padding-left:50px'>$i</td>
						            <td  style=' padding-left:50px'>$data[0]</td>
						            <td  style=' padding-left:40px'>$data[1]</td>
						            <td  style=' padding-left:30px'>$data[2]</td>
						        </tr>
                                ";    
                                $i++;
                            }
							mysqli_close($cn);
							?>               
				</table>
			</form>
		</div>
	</body>
</html>