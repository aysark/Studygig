<div id="content2">
	
	<ul id="user_navbar">
		<li >
			<a href="dashboard">Dashboard</a>
		</li>
		<li class="active">
			<a href="yourUploads">Your Uploads</a>
		</li>
		<li>
			<a href="yourListings">Your Listings</a>
		</li>
		<li>
			<a href="profile">Profile</a>
		</li>
		<li>
			<a href="account">Account</a>
		</li>
		<li>
			<a href="rewards">Rewards</a>
		</li>
	</ul>
	

<!-- MAIN CONTENT START
 ************************
 -->
 
 
<div id="favourites" class="roundedCornerContent">
<?php 
			if(empty($uploads)){
				echo '<p>You haven\'t uploaded any notes yet! Why not <a href="../uploads/insert">upload and earn some points?</a>  You can use the points to download or to <a href="profile">get real life rewards!</a></p>';
			} ?>
		<ul>
		<?php $i=0; ?>
		<?php foreach($uploads as  $upload): ?>
			<li class="clear">
				<h2 class="left"><a href="<?php echo site_url('uploads/view/'. $upload->id);?>"><?php echo $upload->title; ?></a></h2>
				<div class="actions">
					<span class="edit_button">
					<a href="<?php echo site_url('uploads/edit/'.$upload->id);?>">Edit Upload
						</a>
					</span>
				
				<span class="edit_button">
					<a href="<?php echo site_url('uploads/view/'. $upload->id);?>">View Upload
						</a>
					</span>
					
					<span class="edit_button">
					<a href="<?php echo site_url('uploads/delete/'.$upload->id);?>">Delete Upload
						</a>
					</span>
				</div>	

				
				 
	             
				</li>
			</li>
			<?php $i++;?>
		<?php endforeach; ?>
		</ul>
</div><!-- end favourite div -->
 
 
</div><!-- end content div -->



