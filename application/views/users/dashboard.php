<div id="content2">
<div class="twoCol1">
	<div class="roundedCornerContent" id="dashboardGetStarted">
<h2>Welcome to Studygig! Get Started in 3 Simple Steps</h2>
<ul class="dashboardList">
<li><a href="../uploads/insert"><img src="../../images/post-study-material-icon.png" class="textmiddle"> Share  Study Material</a></li>
<li><a href="../classifieds/insert"><img src="../../images/list-study-material-icon.png" class="textmiddle"> List Study Material</a></li>
<li><img src="../../images/download-earn-icon.png" class="textmiddle"> Download & <a href="profile">Earn Rewards</a></li>
</ul>
</div>
<div id="tabs">
	<ul>
		<li class="tabTitle"><a href="#tabs-1"><img src="../../images/001_14.png" class="textmiddle"/> Favourites</a></li>
		<li class="tabTitle"><a href="#tabs-2"><img src="../../images/001_45.png" class="textmiddle"/> Recent Posts</a></li>
		<li class="tabTitle"><a href="#tabs-3"><img src="../../images/001_52.png" class="textmiddle"/> Recent Downloads</a></li>
	</ul>
	<div id="tabs-1">
		<ul>
			
			<?php 
			if(empty($favourites)){
				echo '<p>Start favouriting study material and you\'ll see them here!</p>';
			} ?>
			<?php $i=0; ?>
	<?php foreach($favourites as  $upload): ?>
		<li>
			
			<a href="<?php echo site_url('uploads/view/'. $upload->id);?>"><h2><?php echo $upload->title; ?></h2></a>
			 <h5> <img src="../../images/material<?php echo $upload->material; ?>.png" width="75" height="25" alt="Material Type" class="material-type-icon" /> <img src="../../images/file<?php echo $upload->filetype; ?>.png" width="20" height="20" class="file-type-icon" />
             Uploaded by <?php echo $favouritesUsers[$i]. " on " . date('F j, Y \a\t g:i A', strtotime($upload->created_at));?> in <a href="<?php echo site_url('uploads/getsearchfor/').'/'.substr ($favouritesCourses[$i],0,8);?>"><span class="courseCourseStyle"><?php echo $favouritesCourses[$i];?></span></a></h5>
			
		</li>
		<?php $i++;?>
	<?php endforeach; ?>
	</ul>
	</div>
	
	<div id="tabs-2">
		<?php 
			if(empty($recentuploads)){
				echo '<p>You haven\'t posted any study material yet! Why not <a href="../uploads/insert">post and earn some points?</a>  You can use the points to download or to <a href="profile">get real life rewards!</a></p>';
			} ?>
		<ul>
			<?php $i=0; ?>
	<?php foreach($recentuploads as  $upload): ?>
		<li>
			<h2><a href="<?php echo site_url('uploads/view/'. $upload->id);?>"><?php echo $upload->title; ?></a></h2>
			 <h5> <img src="../../images/material<?php echo $upload->material; ?>.png" width="75" height="25" alt="Material Type" class="material-type-icon" /> <img src="../../images/file<?php echo $upload->filetype; ?>.png" width="20" height="20" class="file-type-icon" />
             Uploaded by <?php echo $recentUploadsUsers[$i]. " on " . date('F j, Y \a\t g:i A', strtotime($upload->created_at));?> in <a href="<?php echo site_url('uploads/getsearchfor/').'/'.substr ($recentUploadsCourses[$i],0,8);?>"><span class="courseCourseStyle"><?php echo $recentUploadsCourses[$i];?></span></a></h5>
			
		</li>
		<?php $i++;?>
	<?php endforeach; ?>
	</ul>
	
	</div>
	
	<div id="tabs-3">
		<?php 
			if(empty($recentdownloads)){
				echo '<p>You haven\'t downloaded yet! Use points to download useful study material you find.  It costs 20 points to download.  You can easily earn points by <a href="../uploads/insert">posting study material.</a></p>';
			} ?>
		<ul>
			<?php $i=0; ?>
	<?php foreach($recentdownloads as  $upload): ?>
	<li>
	<h2><a href="<?php echo site_url('uploads/view/'. $upload->id);?>"><?php echo $upload->title; ?></a></h2>
	 <h5> <img src="../../images/material<?php echo $upload->material; ?>.png" width="75" height="25" alt="Material Type" class="material-type-icon" /> <img src="../../images/file<?php echo $upload->filetype; ?>.png" width="20" height="20" class="file-type-icon" />
     Uploaded by <?php echo $recentDownloadsUsers[$i]. " on " . date('F j, Y \a\t g:i A', strtotime($upload->created_at));?> in <a href="<?php echo site_url('uploads/getsearchfor/').'/'.substr ($recentDownloadsCourses[$i],0,8);?>"><span class="courseCourseStyle"><?php echo $recentDownloadsCourses[$i];?></span></a></h5>
			
		</li>
		<?php $i++;?>
	<?php endforeach; ?>
	</ul>
	</div>
</div>
<?php if($user->oauth_provider): ?>
	<div id="dashboardFacebook">
<script src="http://connect.facebook.net/en_US/all.js#xfbml=1"></script><fb:activity site="http://studygig.com" width="640" height="200" header="true" font="tahoma" border_color="" recommendations="true"></fb:activity>
</div>
<?php endif; ?>


</div>
<div class="twoCol2">
	<br/>
	<span id="dashboardSnapshot">Points </span>  <a href="#" class="dashHelp" title="Use points to download study material (it costs 20 points to download) or trade in your points to redeem real life rewards.  To earn points- simply upload study material!"><img src="../../images/help-icon.gif" width="16" height="15" alt="Help Icon" /></a>  <span id="dashboardNumber"><?php echo $points;?></span>
	<a href="profile">Trade in points for rewards »</a><br/>
	<span id="dashboardSnapshot">Uploads</span> <span id="dashboardNumber"><?php echo $total_uploads;?></span>
		<span id="dashboardSnapshot">Downloads</span> <span id="dashboardNumber"><?php echo $total_downloads;?></span>
	<span id="dashboardSnapshot">Trophies</span> <a href="#" class="dashHelp" title="This feature is still under construction."><img src="../../images/help-icon.gif" width="16" height="15" alt="Help Icon" /></a><span id="dashboardNumber2"><?php echo "None";?></span>
	<br/>
	<span id="dashboardSnapshot">Membership: <?php echo "Free";?></span>
	<br/>
	<a href="../members/index">Become a Member »</a>
	<br/><br/>
	<span id="dashboardSnapshot">Joined:  <?php echo date('F j, Y', strtotime($user->joined));?></span>
	
</div>
</div>

<script type="text/javascript" >
	$(function() {
		$( "#tabs" ).tabs();
		$('.dashHelp').tipsy({gravity: 'w'});
	});
	</script>