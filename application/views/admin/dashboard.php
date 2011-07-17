<h1>Dashboard!</h1>
<p>Total registered users: <?=$stats['total_users']?></p>
<p>Users:</p>
	<ul>
		<?foreach ($all_users as $user):?>
		<li <?if($user->verified == 0) echo 'class="not-verified"'?>><?=$user->username?> - <?=$user->points?></li>
		<?endforeach;?>
	</ul>

<p>Uploads awaiting moderation: </p>
<form method="post" action="<?=site_url('admin/approve')?>">
	<ul>
		<?foreach ($inactive_uploads as $u):?>
		<li><input type="checkbox" name="uploads[]" value="<?=$u->id?>" /> <?=$u->title?> </li>
		<?endforeach;?>
	</ul>
	<input type="submit" value="Approve selected" />
</form>

<p>Flags: </p>

<?if ($flags): ?>

	<ul>
		<?foreach($flags as $flag):?>
			<li><?=$flag->reason?></li>
		<?endforeach;?>
	</ul>

<?else:?>
	<p>No flags!</p>
<?endif?>

<!-- <ul>
<?foreach ($stats['queries'] as $q):?>
<li><?=$q->query?> - <?=$q->ip?></li>
<?endforeach;?>
</ul> -->