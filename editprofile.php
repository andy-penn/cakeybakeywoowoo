<?php
session_start();
require("../constants.php");
require("head.php");
$user = $_SESSION['username'];
$mysql_table = "myreg";
$conn = mysqli_connect("$mysql_host", "$mysql_user", "$mysql_password", "$mysql_database") OR die(mysqli_connect_error());

$sql = "select * from $mysql_table WHERE user = '$user'";
$result = mysqli_query($conn, $sql) or die (mysqli_connect_error($conn));

echo'
<div class="container">
	<div class="outershell">
    	<!--AVATAR AND PROFILE INFO==========================================-->
    	<div class="panel panel-default">
          <div class="panel-heading">
            <h3 class="panel-title">My Details</h3>
          </div>
          <div class="panel-body">                  
                 <div class="col-sm-6 col-md-8">
                 <!-- JOB SECTION -->
					<div class="thumbnail lil-pad">
                    	<div class="alert alert-info" role="alert">
						';
							if(isset($_SESSION['error'])){
								echo '<b><p style="color:red;">'.$_SESSION['error'].'</p></b>';
								$_SESSION['error'] = "";
							}
						echo'
                    	<form action="handle_editprofile.php" method="post" enctype="multipart/form-data" role="form">
						';
						while ($row = mysqli_fetch_array($result)) {
							echo'
							<div class="form-group">
							<img src="./avatars/'.$row['avatar'].'" width="100px">
                            	<label for="photo">Avatar: </label>
                                <input type="file" name="photo"  size="25" >
                            	<label for="mybio">Bio: </label>
                                <textarea class="form-control" name="mybio" rows="4" cols="50" maxsize="200">'.$row['bio'].'</textarea>
                            </div>
                        	<div class="form-group">
                            	<label for="myname">First Name: '.$row['firstname'].'</label>
                                <input type="text" class="form-control" name="myname" value="'.$row['firstname'].'">
                            	<label for="mysname">Surname: '.$row['surname'].'</label>
                                <input type="text" class="form-control" name="mysname"  value="'.$row['surname'].'">
                            </div>
                            <div class="form-group">
                            	<label for="myemail">Email: '.$row['email'].'</label>
                                <input type="text" class="form-control" name="myemail"  value="'.$row['email'].'">
                                <label for="myphone">Phone: '.$row['phone'].'</label>
                                <input type="text" class="form-control" name="myphone"  value="'.$row['phone'].'">
                            </div>
                            <div class="form-group">
                                <label for="myaddress2">Town: '.$row['town'].'</label>
                                <input type="text" class="form-control" name="mytown"  value="'.$row['town'].'">
                                <label for="myaddress3">Post code: '.strtoupper($row['loc']).'</label>
                                <input type="text" class="form-control" name="mypost"  value="'.strtoupper($row['loc']).'">
                            </div>
                           	<input type="submit" id="submit" value="Update">
							';
						}
						echo'
                        </form>
                        </div>
					</div>
                    
                    <!--END OF JOB SECTION -->
                 </div>
          </div>
        </div>
        
    </div><!--outershell-->
</div>
';
require("foot.php");
?>