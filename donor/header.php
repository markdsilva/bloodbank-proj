
<?php
    if(!isset($_SESSION)) {session_start();} 
echo '
    <div class="nav_bg">
    <div class="wrap">
            <ul class="nav">
                <li><a href="chngpwd.php">Change Password</a></li>	
                <li><a href="updateprofile.php">Update Profile</a></li>            
                <li><a href="blooddonated.php">Blood Donated</a></li>
                <li><a href="viewdonations.php">View Donations</a></li>
                <li><a href="viewrequest.php">View Requestes</a></li>
                <li><a href="logout.php">log Out</a></li>
            </ul>
    </div>
</div>
<div class="p1" style="text-align: center;font-size: 20px; margin-top: 20px;color: black;">Welcome, '. $_SESSION['email'].'</div>
'
?>