<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
        <title>Request for blood</title>
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
        <?php include('admin/function.php'); ?>
        <div class="h_bg">
            <div class="wrap">
                <div class="header">
                </div>
            </div>
        </div>
        <div class="nav_bg">
        <div class="wrap">
            <?php require('header.php');?>
        </div>
        <div style="height:530px; width:500px; margin:auto; margin-top:10px; margin-bottom:10px; background-color:#f8f1e4; border:2px solid red; box-shadow:4px 1px 20px black;">
            <form method="post" enctype="multipart/form-data">
                <style>
                    td {
                    padding-left: 30px;
                    }
                </style>
                <table cellpadding="0" cellspacing="0" width="500px" height="480px" style="margin:auto" >
                    <tr>
                        <td colspan="2" align="center"><img src="Images/brequest.jpg" height="90px" /></td>
                    </tr>
                    <tr>
                        <td>&nbsp;</td>
                        <td>&nbsp;</td>
                    </tr>
                    <tr>
                        <td class="lefttd" >Patient Name:</td>
                        <td><input type="text" name="patient" required="required"/></td>
                    </tr>
                    <tr>
                        <td>&nbsp;</td>
                    </tr>
                    <tr>
                        <td class="lefttd">Hospital</td>
                        <td>
                            <select name="hospital" required>
                                <option value="">Select</option>
                                <?php
                                    $cn=makeconnection();
                                    $s="select id,name from hospital";
                                    	$result=mysqli_query($cn,$s);
                                    	$r=mysqli_num_rows($result);
                                    	//echo $r;
                                    	while($data=mysqli_fetch_array($result))
                                    	{
                                    		
                                    		{
                                    			echo "<option value=$data[0]>$data[1]</option>";
                                    		}
                                    	}
                                    	mysqli_close($cn);
                                    
                                    ?>
                            </select>
                        </td>
                    <tr>
                        <td>&nbsp;</td>
                    </tr>
                    <tr>
                        <td class="lefttd" >Select Blood Group </td>
                        <td>
                            <select name="bloodgroup" required>
                                <option value="">Select</option>
                                <?php
                                    $cn=makeconnection();
                                    $s="select * from bloodgroup";
                                    	$result=mysqli_query($cn,$s);
                                    	$r=mysqli_num_rows($result);
                                    	//echo $r;
                                    	while($data=mysqli_fetch_array($result))
                                    	{
                                    		if(isset($_POST["show"])&& $data[0]==$_POST["bloodgroup"])
                                    		{
                                    			echo "<option value=$data[0] selected>$data[1]</option>";
                                    		}
                                    		else
                                    		{
                                    			echo "<option value=$data[0]>$data[1]</option>";
                                    		}
                                    		
                                    	}
                                    	mysqli_close($cn);
                                    
                                    ?>
                            </select>
                        </td>
                    </tr>
                    <tr>
                        <td>&nbsp;</td>
                    </tr>
                    <tr>
                        <td class="lefttd" >E-Mail</td>
                        <td><input type="email" name="email" required="required" /></td>
                    </tr>
                    <tr>
                        <td>&nbsp;</td>
                    </tr>
                    <tr>
                                <td class="lefttd">Required date</td>
                                <td><input type="date" name="required_date" required="required"/></td>
                            </tr>
                    <tr>
                        <td>&nbsp;</td>
                    </tr>
                    <tr>
                        <td class="lefttd">Details</td>
                        <td><textarea name="details"></textarea></td>
                    </tr>
                    <tr>
                        <td>&nbsp;</td>
                    </tr>
                    <tr>
                        <td>&nbsp;</td>
                        <td><input type="submit" value="Submit" name="sbmt" style="border:0px; background:linear-gradient(#900,#D50000); width:100px; height:30px; border-radius:10px 1px 10px 1px; box-shadow:1px 1px 5px black; color:white; font-weight:bold; font-size:14px; text-shadow:1px 1px 6px black; "></td>
                    </tr>
                </table>
            </form>
        </div>
        <div class="clear"></div>
        <?php
        	if (isset($_POST["sbmt"])){
				// $checkdob=$_POST["dateofbirth"];
            	// $today = date("Y-m-d");
            	// $diff = date_diff(date_create($checkdob), date_create($today));
				
				// if($diff->format('%y')<18 || $diff->format('%y')>65){
				// 	echo "<script>alert('Your age must be between 18 and 65');</script>";
				// }
				// else{
					$conn= makeconnection();
					
					if($conn->connect_error){
					die("Connection failed. ".$conn->connect_error);
					}
					$date=date('Y-m-d',strtotime($_POST["required_date"]));

					$sql = "INSERT INTO requests 
                    ( 
                                patient, 
                                hospital, 
                                bloodgroup, 
                                email, 
                                required_date, 
                                details 
                    ) 
                    VALUES 
                    ( 
                                '" . $_POST["patient"] ."', 
                                " . $_POST["hospital"] . ", 
                                " . $_POST["bloodgroup"] . ",
                                '" . $_POST["email"] . "', 
                                '" . $date . "',  
                                '" . $_POST["details"]  ."' 
                    ) 
                    ";"";
                    // print_r($_POST);
					if($conn->query($sql))
					echo '<script>alert("Request sent successfully!")</script>';
					else
					echo '<script>alert("Error!")</script>';
					
					$conn->close();
				
              }
            
            
            ?> 
    </body>
</html>