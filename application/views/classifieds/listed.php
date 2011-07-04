<div id="content2">
	
<div class="twoCol1">
	<h1>Listed "<?php echo $title; ?>" successfully.</h1>		
		<p>Please note your post will be listed for 60 days from now.  After then it will be removed and you will have to list it again.</p>
	<h2>Promote your Post!</h2>
	<p>Tell your friends and classmates by sharing your post on Facebook and Twitter.  You may be able to sell it by tomorrow - you just need to get the word out!</p>
	<div id="fb-root"></div><script src="http://connect.facebook.net/en_US/all.js#xfbml=1"></script><fb:like href="<?php echo site_url('classifieds/view/'. $classified_id);?>" send="true" width="450" show_faces="true" action="recommend" font="tahoma"></fb:like>
	<p><a href="<?php echo site_url('classifieds/view/'. $classified_id);?>" class="twitter-share-button" data-count="none" data-via="studygig">Tweet</a><script type="text/javascript" src="http://platform.twitter.com/widgets.js"></script>
		<span style="margin-left:50px;"><g:plusone></g:plusone></span>
	</p>

	<p><a href="insert" class="uploadAnotherStudyMatButton">Post study material</a>  <a href="../users/dashboard" id="insertUploadButton2">Dashboard</a></p>

</div>


<div class="twoCol2">
	<div class="roundedCornerContent">
		<span class="blueh2">Spread the Word</span>
		<p>Studygig is a community of students all contributing together for a common goal.  The more students know about Studygig the more contributions, which means more downloads and rewards for you!  So be sure to tell everyone about Studygig next class!</p>
	</div>
</div>
</div>
<script type="text/javascript" src="https://apis.google.com/js/plusone.js"></script>