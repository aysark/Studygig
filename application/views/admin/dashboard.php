<div id="content2">

<h1>Studygig Admin Panel</h1>
<p><ul class="horiList">
     <li>Total registered users: <?php echo $stats['total_users']; ?></li>
     <li>Total uploads: <?php echo $stats['total_uploads']; ?></li>
     <li>Total classifieds: <?php echo $stats['total_classifieds']; ?></li>
</ul></p>

<div id="tabs">
	<ul>
		<li><a href="#tabs-1">Overview</a></li>
		<li><a href="#tabs-2">Users</a></li>
		<li><a href="#tabs-3">Shared Posts</a></li>
		<li><a href="#tabs-4">Classified Posts</a></li>
		<li><a href="#tabs-5">Flags</a></li>
	</ul>
	<div id="tabs-1"> <!-- QUICK UPLOAD -->
		<a href="moderators/insert">Click here to upload</a>		
		
	</div>
	<div id="tabs-2"> <!-- USERS DATA -->
		<ul>
		<?php foreach ($all_users as $user):?>
		<li <?php if($user->verified == 0) echo 'class="not-verified"'; ?>><?php echo $user->username; ?> - <?php echo $user->points; ?></li>
		<?php endforeach;?>
	</ul>
	</div>
	<div id="tabs-3"> <!-- UPLOADS DATA -->
		
		<p>Uploads awaiting moderation: </p>
		<form method="post" action="<?php echo site_url('admin/decide'); ?>">
			<ul>
				<?php foreach ($inactive_uploads as $u): ?>
				<li><input type="checkbox" name="uploads[]" value="<?php echo $u->id; ?>" /><a href="<?php echo site_url('admin/view/'.$u->id);?>"><?php echo $u->title;?></a></li>
				<?php endforeach;?>
			</ul>
			<input type="submit" value="Approve selected" id="approve" name="approve" /> <input type="submit" value="Reject selected" id="reject" name="reject" />
		</form>
	</div>
	<div id="tabs-4"> <!-- CLASSIFIEDS DATA -->

	</div>
	<div id="tabs-5"> <!-- CLASSIFIEDS DATA -->
		<?php if ($flags): ?>
		
			<ul>
				<?php foreach($flags as $flag):?>
					<li><?php  echo $flag->reason. " ".$flag->comments; ?></li>
				<?php endforeach;?>
			</ul>
		
		<?php else:?>
			<p>No flags!</p>
		<?php endif?>
	</div>
</div>



<!-- <ul>
<?foreach ($stats['queries'] as $q):?>
<li><?=$q->query?> - <?=$q->ip?></li>
<?endforeach;?>
</ul> -->
</div>