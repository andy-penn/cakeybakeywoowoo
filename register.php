<?php
session_start();
require("head.php");
echo'
<div class="container">
	<div class="outershell">
        	<!--Post a Job Form-->
            <div style="height:40px;"></div>   
            <div class="panel panel-default regpanel">
          		<div class="panel-heading">
            	<h3 class="panel-title"><font size="5px">Users</font></h3>
          		</div>
          		<div class="panel-body">
                <h2>Need a baker or caterer for your special occasion?</h2>
            	<p>Register using the button below and we will get your job seen by hundred of local, rated bakers absolutely FREE!</p>
				<a href="reguser.php" role="button" class="btn btn-info">Register for FREE!</a>
                <div class="clear"></div><!--clear floats--> 
                </div>
            </div>
			
			<div class="panel panel-default regpanel">
          		<div class="panel-heading">
            	<h3 class="panel-title"><font size="5px">Bakers</font></h3>
          		</div>
          		<div class="panel-body">
                <h2>Looking to help local people with their bakery needs?</h2>
            	<p>Register using the button below and we will show you local jobs absolutely FREE!</p>
				<a href="regbaker.php" role="button" class="btn btn-info">Register as a Baker!</a>
                <div class="clear"></div><!--clear floats--> 
                </div>
            </div>
			<div style="height:40px;"></div> 
            <div class="clear"></div><!--clear floats-->
    </div><!--outershell-->
</div>
';
require("foot.php");

?>
