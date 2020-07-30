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

                <table cellpadding="20" cellspacing="20" width="300px"  style="margin:auto">
                <!-- <style>
                        td{
                            border: 1px solid #808080;
                            padding: 5px;
                        }
                    </style> -->
                    <!-- <tr><td>&nbsp;</td><td>&nbsp;</td></tr>    -->

                    <tr style="background-color:bisque" align="center" class="bold">
                       <td <td style='border: 1px solid #808080;
                            padding: 5px;'align="center">Id</td>
                       <td <td style='border: 1px solid #808080;
                            padding: 5px;'align="center">User Name</td>
                    </tr>
                    <?php
                        error_reporting(0);
                        $cn=makeconnection();
                        

                        $s ="SELECT ROW_NUMBER() OVER (ORDER BY username) as no,username from user";
                                    
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
                        </tr>
                        ";
                        }
                        mysqli_close($cn);
                        ?>
                        <tr>&nbsp;</tr>
                        <tr>&nbsp;</tr>
                        <tr>&nbsp;</tr>

                </table>
            </form>
        </div>
            </div>
        
    </body>
</html>