<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
        <title>Untitled Document</title>
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
        <?php include('Admin/function.php'); ?>
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
        <div style=" height:auto">

        <!-- $s="select name,gender,age,mobile,city,email from donor where donor.bloodgroup='". $_REQUEST['bg']."'"; -->

        <form method="post" enctype="multipart/form-data">
            <div class="p1" style="text-align: center;font-size: 40px; margin-top: 40px; margin-bottom:30px ;color: Maroon;  font-family: 'Times New Roman', Times, serif;">Donor</div>

                <table cellpadding="20" cellspacing="20" width="1300px"  style="margin:auto">
                    <style>
                        td{
                            border: 1px solid #808080;
                            padding: 5px;
                            vertical-align: middle;
                            text-align: center;
                        }
                    </style>
                    <!-- <tr><td>&nbsp;</td><td>&nbsp;</td></tr>    -->

                    <tr style="background-color:bisque" align="center" class="bold">
                        <td align="center">No.</td>
                        <td align="center">Name</td>
                        <td align="center">Gender</td>
                        <td align="center">Age</td>
                        <td align="center">Mobile</td>
                        <td align="center">Email</td>
                        <td align="center">State</td>
                        <td align="center">District</td>
                        <td align="center">Bloodbank</td>
                    </tr>
                    <?php
                        error_reporting(0);
                        $cn = makeconnection();
                        // $s="select no,name,gender,age,mobile,city,email from donor where donor.bloodgroup='". $_REQUEST['bg']."'";

                        $s = "SELECT
                                ROW_NUMBER() OVER (ORDER BY donor.name) as no,
                                donor.name AS name,
                                donor.gender AS gender,
                                TIMESTAMPDIFF(YEAR, dateofbirth, CURDATE()) as age,
                                donor.mobile AS mobile,
                                donor.email AS email,
                                states.name AS state,
                                districts.name AS district,
                                bloodbank.name AS bloodbank 
                            FROM
                                donor 
                                JOIN states on states.id=donor.state_id
                                join districts on districts.id=donor.district_id
                                JOIN bloodbank on bloodbank.id=donor.bloodbank
                                AND donor.bloodgroup='". $_REQUEST['bg']."';";
                        // $s = "SELECT * from camp";
                                    
                        $result = mysqli_query($cn, $s);
                        $r = mysqli_num_rows($result);
                        while ($data = mysqli_fetch_array($result))
                        {
                        echo "
                        <tr>
                           <td>$data[0]</td>
                           <td>$data[1]</td>
                           <td>$data[2]</td>
                           <td>$data[3]</td>
                           <td>$data[4]</td>
                           <td>$data[5]</td>
                           <td>$data[6]</td>
                           <td>$data[7]</td>
                           <td>$data[8]</td>
                        </tr>
                        ";
                        }
                        mysqli_close($cn);
                        ?>
                </table>
            </form>
        </div>
    </body>
</html>