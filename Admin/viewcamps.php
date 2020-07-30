<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
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
        <div class="h_bg">
            <div class="wrap">
                <div class="header">
                </div>
            </div>
        </div>
        <!-- <div style="height:300px; width:1000px; margin:auto; margin-top:50px; margin-bottom:50px; background-color:#f8f1e4; border:2px solid red; box-shadow:4px 1px 20px black;"> -->
        <form method="post" enctype="multipart/form-data"   style="margin-bottom: 80px;">
            <div class="p1" style="text-align: center;font-size: 40px; margin-top: 40px; margin-bottom:30px ;color: Maroon;  font-family: 'Times New Roman', Times, serif;"></div>

                <table cellpadding="20" cellspacing="20" width="1300px"  style="margin:auto">
                    <!-- <style>
                        td{
                            border: 1px solid #808080;
                            padding: 5px;
                        }
                    </style> -->
                    <!-- <tr><td style='border: 1px solid #808080;
                            padding: 5px;'>&nbsp;</td><td style='border: 1px solid #808080;
                            padding: 5px;'>&nbsp;</td></tr>    -->

                    <tr style="background-color:bisque" align="center" class="bold">
                        <td style='border: 1px solid #808080;
                            padding: 5px;' align="center">No.</td>
                        <td style='border: 1px solid #808080;
                            padding: 5px;' align="center">Name</td>
                        <td style='border: 1px solid #808080;
                            padding: 5px;' align="center">Organised By</td>
                        <td style='border: 1px solid #808080;
                            padding: 5px;' align="center">Date</td>
                        <td style='border: 1px solid #808080;
                            padding: 5px;' align="center">Time</td>
                        <td style='border: 1px solid #808080;
                            padding: 5px;' align="center">State</td>
                        <td style='border: 1px solid #808080;
                            padding: 5px;' align="center">District</td>
                        <td style='border: 1px solid #808080;
                            padding: 5px;' align="center">Address</td>
                        <td style='border: 1px solid #808080;
                            padding: 5px;' align="center">Email</td>
                        <td style='border: 1px solid #808080;
                            padding: 5px;' align="center">Bloodbank</td>
                    </tr>
                    <?php
                        error_reporting(0);
                        $cn = makeconnection();
                   
                        $s ="SELECT c.id   AS No, 
                                    c.name                                AS name, 
                                    c.organised_by                        AS organised_by, 
                                    Date_format(c.date, '%d/%m/%Y')       AS DATE, 
                                    Concat(c.start_time, '-', c.end_time) AS TIME, 
                                    s.name                                AS state, 
                                    d.name                                AS district, 
                                    c.address                             AS address, 
                                    c.email                               AS email, 
                                    b.name                                AS bloodbank 
                            FROM   camp c 
                                    JOIN states s 
                                    ON c.state = s.id 
                                    JOIN districts d 
                                    ON c.district = d.id 
                                    JOIN bloodbank b 
                                    ON b.id = c.bloodbank";
                                    
                        $result = mysqli_query($cn, $s);
                        $r = mysqli_num_rows($result);
                        while ($data = mysqli_fetch_array($result))
                        {
                        echo "
                        <tr>
                           <td style='border: 1px solid #808080;
                            padding: 5px;'>$data[0]</td>
                           <td style='border: 1px solid #808080;
                            padding: 5px;'>$data[1]</td>
                           <td style='border: 1px solid #808080;
                            padding: 5px;'>$data[2]</td>
                           <td style='border: 1px solid #808080;
                            padding: 5px;'>$data[3]</td>
                           <td style='border: 1px solid #808080;
                            padding: 5px;'>$data[4]</td>
                           <td style='border: 1px solid #808080;
                            padding: 5px;'>$data[5]</td>
                           <td style='border: 1px solid #808080;
                            padding: 5px;'>$data[6]</td>
                           <td style='border: 1px solid #808080;
                            padding: 5px;'>$data[7]</td>
                           <td style='border: 1px solid #808080;
                            padding: 5px;'>$data[8]</td>
                           <td style='border: 1px solid #808080;
                            padding: 5px;'>$data[9]</td>
                        </tr>
                        ";
                        }
                        mysqli_close($cn);
                        ?>
                </table>
            </form>
        </div>
            </div>
        
    </body>
</html>