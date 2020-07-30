<?php if(!isset($_SESSION)) {session_start();}  ?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
	<head>
		<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
		<title>Untitled Document</title>
		<link href="StyleSheet.css" rel="stylesheet" type="text/css" />
		<link href='http://fonts.googleapis.com/css?family=Source+Sans+Pro' rel='stylesheet' type='text/css'>
		<link href="css/style.css" rel="stylesheet" type="text/css" media="all" />
		<!--slider-->
		<link href="css/flexslider.css" rel="stylesheet" type="text/css" media="all" />
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
	
	<body onload='loadStates()'>
		<?php
			if($_SESSION['loginstatus']=="")
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
					<?php
  $db =makeconnection();
  $query = "SELECT id,name FROM states";
  $result = $db->query($query);

  while($row = $result->fetch_assoc()){
    $states[] = array("id" => $row['id'], "val" => $row['name']);
  }

  $query = "SELECT id, state_id, name FROM districts";
  $result = $db->query($query);

  while($row = $result->fetch_assoc()){
    $districts[$row['state_id']][] = array("id" => $row['id'], "val" => $row['name']);
  }

  $jsonStates = json_encode($states);
  $jsonDistricts = json_encode($districts);


?>
    <script type='text/javascript'>
      <?php
        echo "var states = $jsonStates; \n";
        echo "var districts = $jsonDistricts; \n";
      ?>
      function loadStates(){
        var select = document.getElementById("statesSelect");
        select.onchange = updateDistricts;
        for(var i = 0; i < states.length; i++){
          select.options[i] = new Option(states[i].val,states[i].id);          
        }
      }
      function updateDistricts(){
        var statesSelect = this;
        var state_id = this.value;
        var districtSelect = document.getElementById("districtsSelect");
        districtSelect.options.length = 0; //delete all options if any present
        for(var i = 0; i < districts[state_id].length; i++){
          districtSelect.options[i] = new Option(districts[state_id][i].val,districts[state_id][i].id);
        }
      }
    </script>
					<form method="post" enctype="multipart/form-data">
						<table border="0" align="center" width="400" height="300px" class="shaddoww">
							<tr>
								<td colspan="2" align="center" class="toptd">Add Camp </td>
							</tr>
							<tr>
								<td colspan="2">&nbsp;</td>
							</tr>
							<tr>
								<td class="lefttd">Camp Name</td>
								<td><input type="text" name="name" required="required"/></td>
							</tr><tr><td colspan="2">&nbsp;</td></tr>

							<tr>
								<td class="lefttd">Organised By</td>
								<td><input type="text" name="organised_by" required="required"/></td>
							</tr><tr><td colspan="2">&nbsp;</td></tr>

							<tr>
								<td class="lefttd">Date</td>
								<td><input type="date" name="date" required="required"/></td>
							</tr><tr><td colspan="2">&nbsp;</td></tr>

							<tr>
								<td class="lefttd">Start-time</td>
								<td><input type="time" name="start_time" required="required"/></td>
							</tr><tr><td colspan="2">&nbsp;</td></tr>

							<tr>
								<td class="lefttd">End-time</td>
								<td><input type="time" name="end_time" required="required"/></td>
							</tr><tr><td colspan="2">&nbsp;</td></tr>

							<tr>
								<td class="lefttd">State</td>
								<td>
									<select name="state" id='statesSelect' required>
										<option value="">Select State</option>
									</select>
								</td>
							</tr><tr><td colspan="2">&nbsp;</td></tr>

							<tr>
								<td class="lefttd">District</td>
								<td>
									<select name="district" id='districtsSelect' required>
										<option value="">Select District</option>
									</select>
								</td>
							</tr><tr><td colspan="2">&nbsp;</td></tr>

							<tr>
								<td class="lefttd">Address</td>
								<td><input type="textarea" name="address" required="required"/></td>
							</tr><tr><td colspan="2">&nbsp;</td></tr>

							<tr>
								<td class="lefttd">Email</td>
								<td><input type="email" name="email" required="required"/></td>
							</tr><tr><td colspan="2">&nbsp;</td></tr>

							<tr>
                                <td class="lefttd"> Blood Bank </td>
                                <td>
                                    <select name="bloodbank" required>
                                        <option value="">Select Bloodbank</option>
                                        <?php
                                    
                                            $conn= makeconnection();
                                            $s="select id,name from bloodbank";
                                            $result = $conn->query($s);
                                            while($data= $result-> fetch_array(MYSQLI_NUM))
                                            {
                                            	if(isset($_POST["show"])&& $data[0]==$_POST["s2"])
                                            	{
                                            		echo "<option value=$data[0] selected>$data[0]</option>";
                                            	}
                                            	else
                                            	{
                                            		echo "<option value=$data[0]>$data[1]</option>";
                                            	}
                                            }
                                            $conn->close();
                                            
                                            ?>
                                    </select>
                                </td>
                            </tr><tr><td colspan="2">&nbsp;</td></tr>

							<tr>
								<td>&nbsp;</td>
								<td><input type="submit" value="SAVE" name="sbmt"></td>
							</tr><tr><td colspan="2">&nbsp;</td></tr>

						</table>
					</form>

				</div>
			</div>
		</center>
		<?php
        	if (isset($_POST["sbmt"])){
				
					$conn= makeconnection();
					
					if($conn->connect_error){
					die("Connection failed. ".$conn->connect_error);
                    }
					$date=date('Y-m-d',strtotime($_POST["date"]));

					$sql = "insert into camp(name,organised_by,date,start_time,end_time,state,district,address,email,bloodbank) values('" . $_POST["name"] ."','" . $_POST["organised_by"] ."','" . $_POST["date"] ."','" . $_POST["start_time"] ."','" . $_POST["end_time"] . "'," . $_POST["state"] . "," . $_POST["district"] . ",'" . $_POST["address"]  ."','" . $_POST["email"] ."'," . $_POST["bloodbank"] .")";"";
				
					if($conn->query($sql))
					echo '<script>alert("Camp added!")</script>';
					else
					echo '<script>alert("Error!")</script>';
					
					$conn->close();
				
              }
            
            
            ?> 
	</body>
	<?php include('viewcamps.php'); ?>

</html>