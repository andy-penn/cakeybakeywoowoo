<?php
echo'
<!--</div>--> <!-- /container -->
<!-- FOOTER -->
<div class="myfooter">
  <div class="footlogo"><img src="images/cbww-logo-footer.png" /></div>
  
    <div class="socialmedia"> 
     <ul>
        <li id="twitter" class="1column" style="float:none;"><a href="#">Twitter</a></li>
        <li id="facebook" class="1column" style="float:none;"><a href="#">Facebook</a></li>
        <li id="pinterest" class="1column" style="float:none;"><a href="#">Pinterest</a></li>
        <li id="google" class="1column" style="float:none;"><a href="#">Google</a></li>
        <li id="youtube" class="1column" style="float:none;"><a href="#">YouTube</a></li>
        <li id="linkedin" class="1column" style="float:none;"><a href="#">LinkedIn</a></li>
     </ul>                    
    </div>
  
  
    <div class="minimenu">
        <ul>
        <li class="1column" style="float:none;"><a href="#">Home</a></li>
        <li class="1column" style="float:none;"><a href="#">About Us</a></li>
        <li class="1column" style="float:none;"><a href="#">Find a Baker</a></li>
        <li class="1column" style="float:none;"><a href="#">Find a Job</a></li>
        <li class="1column" style="float:none;"><a href="#">Contact Us</a></li>	
        </ul>
    </div>
  
 <p class="copytext"><span>© Copyright 2015  |  Company number: 00000000  |  VAT number: 000000000</span></p>
</div>

    <!-- Bootstrap core JavaScript
    ================================================== -->
    <!-- Placed at the end of the document so the pages load faster -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.2/jquery.min.js"></script>
    <script src="js/bootstrap.min.js"></script>

    <!-- IE10 viewport hack for Surface/desktop Windows 8 bug -->
    <script src="js/ie10-viewport-bug-workaround.js"></script>
    <!-- jQuery -->
    <script src="js/jquery.js"></script>
      <script>
  	$(window).scroll(function(){
		if ($(window).scrollTop() > 170) {
			$(\'#logo\').show();
		}
		else 
		{
			 $(\'#logo\').hide();
		}
	});
  </script>
      <link rel="stylesheet" href="http://code.jquery.com/ui/1.10.3/themes/smoothness/jquery-ui.css" />
    <script src="http://code.jquery.com/jquery-1.9.1.js"></script>
    <script src="http://code.jquery.com/ui/1.10.3/jquery-ui.js"></script>
    <script>
      $(function() {
          $("#datepicker").datepicker({ dateFormat: "dd-mm-yy" }).val();
      });
    <!-- date was dd-mm-yy.-->
	</script>
  </body>
</html>
';

?>