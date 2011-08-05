<div id="content2">
	
<div class="twoCol1">
	<h1>Uploaded <?php echo $numOfFiles ?> file(s) successfully.</h1>
	<div class="ui-state-highlight ui-corner-all" style="padding-top: 0px; padding-right: 0.7em; padding-bottom: 0px; padding-left: 0.7em; margin-bottom:15px; width:90%;" >You've gained <?php 
	if ($upload_data == ""){
		if ($material == 0){
			echo "15";
		}else if ($material == 1){
			echo "5";
		}else if ($material == 2){
			echo "5";
		}else if ($material == 3){
			echo "3";
		}else if ($material == 4){
			echo "3";
		}else if ($material == 5){
			echo "3";
		}else{
			echo "1";
		}
	}else{
		if ($material == 0){
			echo "20";
		}else if ($material == 1){
			echo "15";
		}else if ($material == 2){
			echo "10";
		}else if ($material == 3){
			echo "5";
		}else if ($material == 4){
			echo "5";
		}else if ($material == 5){
			echo "5";
		}else{
			echo "1";
		}
	}
	?> points!</div>
		
		<ul>
<?php  
if ($upload_data == ""){
	echo 'Uploaded: '.$link;
}else{
	foreach($upload_data as $file) {
	    echo '<li><ul>';
	    foreach ($file as $item => $value) {
	        echo '<li>'.$item.': '.$value.'</li>';
	    }
	    echo '</ul></li>';
	 } 
}
?>
</ul>
		<br/>
	<h2>Promote your Post!</h2>
	<p>Tell your friends and classmates by sharing your post on Facebook and Twitter.  Remember, when someone downloads your study material- you get 2 points every time!</p>
	<div id="fb-root"></div><script src="http://connect.facebook.net/en_US/all.js#xfbml=1"></script><fb:like href="<?php echo site_url('uploads/view/'. $upload_id);?>" send="true" width="450" show_faces="true" action="recommend" font="tahoma"></fb:like>
	<p><a href="http://twitter.com/share" class="twitter-share-button" data-count="none" data-via="studygig" data-url="<?php echo site_url('uploads/view/'. $upload_id);?>" data-text="I just shared study material on Studygig! #yorku" >Tweet</a><script type="text/javascript" src="http://platform.twitter.com/widgets.js"></script>
		<span style="margin-left:50px;"><g:plusone></g:plusone></span>
	</p>

	<p><a href="insert" class="insertUploadButton">Post study material</a>  <a href="../users/dashboard" id="insertUploadButton2">Dashboard</a></p>

</div>


<div class="twoCol2">
	<div class="roundedCornerContent">
		<span class="blueh2">Spread the Word</span>
		<p>Studygig is a community of students all contributing together for a common goal.  The more students know about Studygig the more contributions, which means more downloads and rewards for you!  So be sure to tell everyone about Studygig next class!</p>
	</div>
</div>
</div>
<script type="text/javascript" src="https://apis.google.com/js/plusone.js"></script>