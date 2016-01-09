<?php
session_start();
require("head.php");
echo'
<div class="container">
	<div class="outershell">
        	<!--Post a Job Form-->
            <div class="top_ad_1">
            	<script async src="//pagead2.googlesyndication.com/pagead/js/adsbygoogle.js"></script>
                <!-- top ad 1 post job -->
                <ins class="adsbygoogle"
                     style="display:inline-block;width:728px;height:90px"
                     data-ad-client="ca-pub-8712788469684599"
                     data-ad-slot="5452824679"></ins>
                <script>
                (adsbygoogle = window.adsbygoogle || []).push({});
                </script>
            </div>
            <div class="top_ad_2">
            	<script async src="//pagead2.googlesyndication.com/pagead/js/adsbygoogle.js"></script>
                <!-- top ad 2 post job -->
                <ins class="adsbygoogle"
                     style="display:inline-block;width:320px;height:100px"
                     data-ad-client="ca-pub-8712788469684599"
                     data-ad-slot="6929557875"></ins>
                <script>
                (adsbygoogle = window.adsbygoogle || []).push({});
                </script>
            </div>
                       
            <div class="rightbox alert alert-info" role="alert">
            
                <h2>Need a baker or caterer for your special occasion?</h2>
            	<p>Describe your requirements using the form below and we will get you quotes from local, rated bakers absolutely FREE!</p>
                <div class="clear"></div><!--clear floats--> 
                	<form action="handle_jobpost.php" method="post" onsubmit="return confirm(\'Are you sure you want to Submit this job?\')"> 
                    <label for="type">Select a Job Type: <b style="color:orange;">*</b></label>
                    <select name="type">
                        <option value="none">Please select a job Type</option>
                        <option value="weddingcake">Wedding Cake</option>
                        <option value="birthdaycake">Birthday Cake</option>
                        <option value="eventcake">Special Event Cake</option>
                        <option value="seasonalcake">Seasonal Cake</option>
                        <option value="bereavementcake">Bereavement Cake</option>
                        <option value="cookies">Cookies</option>
                        <option value="muffins">Muffins</option>
                        <option value="cupcakes">Cup Cakes</option>
                        <option value="savory">Savory Goods</option>
                        <option value="other">Other</option>
                    </select>
                    <div class="infobox">Welcome to Cakey Bakey Woowoo! Please fill out the form with as much details as possible to help people to quote as accurately as possible.</div>
                    <div class="clear"></div><!--clear floats-->               
                    <hr>
                    
                    <label for="jobtitle">Name your Job: <b style="color:orange;">*</b></label>
                    <input type="text" name="jobtitle" placeholder="Job Title" />
                    <div class="infobox">For example: <br><br>50\'s style Birthday Cake<br>Three tier wedding cake<br>Buffet for 30 people</div>
                    <div class="clear"></div><!--clear floats--> 
                    <hr>
                    <label for="info">Describe your requirements: <b style="color:orange;">*</b></label>
                    <textarea name="info" style="resize:none" rows="4" cols="50" placeholder="Job Description"></textarea>
                    <div class="infobox">The more detail you enter the more interest you will generate for you job. <br><br>For a best response, consider including:<br><br>
                    <ul>
                        <li>Approximate sizes</li>
                        <li>Services needed: a one of job, ongoing service, business catering</li>
                        <li>Number of tiers</li>
                        <li>preferred ingredients</li>
                        <li>dietary needs</li>
                        <li>Any allergens</li>
                        </ul>
                    </ul> 
                    </div>
                    <div class="clear"></div><!--clear floats--> 
                    <hr>
                    <label for="end">When do you need it for?: <b style="color:orange;">*</b></label>
                    <input type="text" name="end" id="datepicker" placeholder="Due Date" />
                    <div class="infobox">Please give bakers an idea of when you\'d like to get the work done.</div>
                    <div class="clear"></div><!--clear floats-->  
                    <hr>
                    <label for="postcode">Enter your postcode: <b style="color:orange;">*</b></label>
                    <input type="text" name="postcode" placeholder="Postcode (uk)" />
                    <div class="infobox">Full area code/postcode of the location where you need a baker. This will be used to get local bakers.</div>
                    <div class="clear"></div><!--clear floats-->
                    <hr>
                    <input type="submit" value="Post Job" />
                    <!-- on mybuilder.com after filling the job and posting it gives you 5 spaces to invite people from the site to view the job.-->
                </form>
                <div class="clear"></div><!--clear floats--> 
            </div>
            <!--close box border-->
            
            <div class="leftbox">
            	<div class="side_reg">
                	<p>Register with Cakey Bakey!</p>
                    <p class="norm_text">Gain access to a world of top quality, rated bakers</p>
                    <a class="fake_button" href="#">Click Here!</a>
                </div>
            	<div class="sidead1">
                	<script async src="//pagead2.googlesyndication.com/pagead/js/adsbygoogle.js"></script>
                    <!-- side ad 1 post job -->
                    <ins class="adsbygoogle"
                         style="display:inline-block;width:300px;height:250px"
                         data-ad-client="ca-pub-8712788469684599"
                         data-ad-slot="2499358271"></ins>
                    <script>
                    (adsbygoogle = window.adsbygoogle || []).push({});
                    </script>
                </div>
                <div class="side_reg">
                	<p>Register with Cakey Bakey!</p>
                    <p class="norm_text">Gain access to a world of top quality, rated bakers</p>
                    <a class="fake_button" href="#">Click Here!</a>
                </div>
                <div class="side_reg">
                	<p>Register with Cakey Bakey!</p>
                    <p class="norm_text">Gain access to a world of top quality, rated bakers</p>
                    <a class="fake_button" href="#">Click Here!</a>
                </div>
                <div class="sidead1 sidead2">
                	<script async src="//pagead2.googlesyndication.com/pagead/js/adsbygoogle.js"></script>
                    <!-- side ad 2 post job -->
                    <ins class="adsbygoogle"
                         style="display:inline-block;width:300px;height:250px"
                         data-ad-client="ca-pub-8712788469684599"
                         data-ad-slot="3498413478"></ins>
                    <script>
                    (adsbygoogle = window.adsbygoogle || []).push({});
                    </script>
                </div>
            </div>
            <div class="clear"></div><!--clear floats-->
    </div><!--outershell-->
	</div>
';
require("foot.php");

?>
