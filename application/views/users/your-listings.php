<div id="content2">
	
	<ul id="user_navbar">
		<li >
			<a href="dashboard">Dashboard</a>
		</li>
		<li>
			<a href="yourUploads">Your Uploads</a>
		</li>
		<li class="active">
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
			if(empty($classifieds)){
				echo '<p>You haven\'t listed any study material yet! Why not <a href="../classifieds/insert">list?</a></p>';
			} ?>
		<ul>
		<?php $i=0; ?>
		<?php foreach($classifieds as  $listing): ?>
			<li class="clear">
				<h2 class="left"><a href="<?php echo site_url('classifieds/view/'. $listing->id);?>"><?php echo $listing->title; ?></a></h2>
				<div class="actions">
					<span class="edit_button">
					<a href="<?php echo site_url('classifieds/edit/'.$listing->id);?>">Edit Listing
						</a>
					</span>
				
				<span class="edit_button">
					<a href="<?php echo site_url('classifieds/view/'. $listing->id);?>">View Listing
						</a>
					</span>
					
					<span class="edit_button">
					<a href="<?php echo site_url('classifieds/delete/'.$listing->id);?>">Delete Listing
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



