<?php if(!isset($_SESSION)) {session_start();} ?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
        <title>Update Profile</title>
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
    <body onload='loadStates()'>
        <?php if($_SESSION[ 'donorstatus']=="" ) { header( "location:../login.php"); } ?>
        <?php include( 'function.php'); ?>
        <?php $cn = makeconnection();
                $s = "select * from donor where email='" . $_SESSION["email"] . "'";
                $q = mysqli_query($cn, $s);
                $r = mysqli_num_rows($q);
                $data = mysqli_fetch_array($q);


               
                
                $name = $data['name'];
                $gender = $data['gender'];
                $dateofbirth = $data[3];
                $mobile = $data['mobile'];
                $state= $data['state_id'];
                $district= $data['district_id'];
                $bloodbank= $data['bloodbank'];

                $s1 = "select bloodgroup.* from bloodgroup,donor where bloodgroup.bg_id=".$data['bloodgroup'];
                $q1 = mysqli_query($cn, $s1);
                // $r1 = mysqli_num_rows($q1);
                $data1 = mysqli_fetch_array($q1);
                $bloodgroup =$data1['bg_name'];
        ?>
        <div class="h_bg">
            <div class="wrap">
                <div class="header"></div>
            </div>
        </div>
        <div class="nav_bg">
        <div class="wrap">
            <?php require ( 'header.php'); ?>
        </div>
        <div style="height:530px; width:700px; margin:auto; margin-top:10px; margin-bottom:10px; background-color:#f8f1e4; border:2px solid red; box-shadow:4px 1px 20px black;">
        
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

        <form method="post" enctype="multipart/form-data" name="myForm">
        <div class="p1" style="text-align: center;font-size: 40px; margin-top: 40px;color: red;">Update Profile</div>

            <table cellpadding="0" cellspacing="0" style="margin:auto; width:100%; " >
              
                <tr>
                    <td colspan="2">&nbsp;</td>
                </tr>
                <tr>
                    <td  style=" padding-left:20px;" > </td>
                    <td style="vertical-align:top;padding-top:20px;">
                        <table cellpadding="0" cellspacing="0" style="width:100%; height:400px;">
                            <tr>
                                <td class="lefttd">Donor Name</td>
                                <td><input type="text" name="name" value="<?php echo @$name;  ?>" required="required" pattern="[a-zA-Z _]{4,15}" title="please enter only character  between 4 to 15 for donor name" /></td>
                            </tr>
                            <tr>
                                <td class="lefttd">Gender</td>
								<td>
                                    <input name="gender" type="radio" value="male" <?php if($gender=="male" ){ echo "checked" ;} ?>>Male
                                    <input name="gender" type="radio" value="female" <?php if($gender=="female" ){ echo "checked" ;} ?>/>Female
                                    <input name="gender" type="radio" value="transgender" <?php if($gender=="transgender" ){ echo "checked" ;} ?>/>Transgender
                                </td>                         
							</tr>
                            <tr>
                                <td class="lefttd">Date Of Birth</td>
                                <td><input type="date" name="dateofbirth" value="<?php echo @$dateofbirth; ?>" required="required"/></td>
                            </tr>
                            <tr>
                                <td class="lefttd">Mobile No</td>
                                <td><input type="number" name="mobile" required="required"  value="<?php echo @$mobile; ?>"pattern="[0-9]{10,11}" title="please enter only numbers between 10 to 11 for mobile no." /></td>
                            </tr>
							<tr>
                                <td class="lefttd">State</td>
                                <td><select name="state" id='statesSelect' required>
                                        <option value="">Select State</option>
                                       
                                    </select></td>
                            </tr>
                            <tr>
                                <td class="lefttd">District</td>
                                <td><select name="district" id='districtsSelect' required>
                                        <option value="">Select District</option>
                                    </select></td>
                            </tr>
                            <tr>
                                <td class="lefttd">Blood Group</td>
                                <td><input type="text" disabled  name="bloodgroup" value="<?php echo @$bloodgroup; ?>"/></td>
                            </tr>
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
                            </tr>
                            <tr>
                                <td class="lefttd">Email-id</td>
                                <td><input type="text" disabled  value="<?php echo @$_SESSION["email"]; ?>"/></td>
                            </tr>
        
                            <tr>
                                <td>&nbsp;</td>
                                <td><input type="submit" value="Update" name="sbmt" style="border:0px; background:linear-gradient(#900,#D50000); width:100px; height:30px; border-radius:10px 1px 10px 1px; box-shadow:1px 1px 5px black; color:white; font-weight:bold; font-size:14px; text-shadow:1px 1px 6px black; "></td>
                            </tr>
                        </table>
                    </td>
                </tr>
            </table>
        </form>
        </div>
        <?php 
        if (isset($_POST["sbmt"]))
        {
            $checkdob=$_POST["dateofbirth"];
            $today = date("Y-m-d");
            $diff = date_diff(date_create($checkdob), date_create($today));
            if($diff->format('%y')<18 || $diff->format('%y')>65){
                echo "<script>alert('Your age must be between 18 and 65');</script>";
            }else{
                    $cn = makeconnection();
                    $dob=date('Y-m-d',strtotime($_POST["dateofbirth"]));
                    // echo $date;
                    $s = "update donor set name='" . $_POST["name"] . "' ,gender='" . $_POST["gender"] . "' , dateofbirth='" . $dob . "',mobile=" . $_POST["mobile"] . ",state_id=". $_POST["state"]. ",district_id=". $_POST["district"]. ",bloodbank=". $_POST["bloodbank"]." where email='" . $_SESSION["email"] . "'";
                    $i = mysqli_query($cn, $s);
                    mysqli_close($cn);
                    echo "<script>alert('Record update');</script>";
                }
        } ?>
    </body>
</html>