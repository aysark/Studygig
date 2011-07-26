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
		<li><a href="#tabs-3">Shared Posts <?php if(count($inactive_uploads) > 0) echo "(". count($inactive_uploads) .")"; ?></a></li>
		<li><a href="#tabs-4">Classified Posts <?php if(count($inactive_classifieds) > 0) echo "(". count($inactive_classifieds) .")"; ?></a></li>
		<li><a href="#tabs-5">Flags <?php if(count($flags) > 0) echo "(". count($flags) .")"; ?></a></li>
	</ul>
	<div id="tabs-1"> <!-- QUICK UPLOAD -->
		<a href="moderators/insert">Click here to upload</a>	
		
	</div>
	<div id="tabs-2"> <!-- USERS DATA -->
		<?php
		$this->table->set_heading('ID', 'Username', 'Points');

		foreach($all_users as $user) {
			if ( $user->verified == 0 ) $cell = array('data' => $user->id, 'class' => 'not-verified');
				else
			$cell = array('data' => $user->id);

			$this->table->add_row($cell, $user->username, $user->points);
		}

		echo $this->table->generate();
		?>
	
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
			<input type="hidden" id="classifieds" value="0" />
		</form>
	</div>
	<div id="tabs-4"> <!-- CLASSIFIEDS DATA -->

		<p>Classifieds awaiting moderation: </p>
		<form method="post" action="<?php echo site_url('admin/decide'); ?>">
			<ul>
				<?php foreach ($inactive_classifieds as $c): ?>
				<li><input type="checkbox" name="classifieds[]" value="<?php echo $c->id; ?>" /><a href="<?php echo site_url('admin/viewclassified/'.$c->id);?>"><?php echo $c->title;?></a></li>
				<?php endforeach;?>
			</ul>
			<input type="submit" value="Approve selected" id="approve" name="approve" /> <input type="submit" value="Reject selected" id="reject" name="reject" />
			<input type="hidden" id="classifieds" value="1" />
		</form>

	</div>
	<div id="tabs-5"> <!-- FLAGS DATA -->
		<?php if ($flags): ?>

			<?php
			$this->table->set_heading('Reason', 'User', 'Upload ID', 'Date added', 'Comment');

			foreach($flags as $flag) {

				switch($flag->reason) {
					case 1 : $reason = "Spam";
					break;
					case 2 : $reason = "Infringes My Rights";
					break;
					case 3 : $reason = "Bad Content";
					break;
					case 4 : $reason = "Other";
					break;
				}

				$this->table->add_row($reason, '<a href="'. site_url('admin/viewuser/'. $flag->user_id).'">View user</a>', '<a href="'. site_url('admin/view/'. $flag->upload_id).'">View upload</a>', $flag->date, $flag->comments);
			}

			echo $this->table->generate();
			?>

		
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