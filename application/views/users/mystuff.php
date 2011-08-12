<p>Uploads</p>
<ul>
<?php foreach($alluploads as $upload): ?>

	<li><?php echo $upload->title ?> <a href="<?php echo site_url('uploads/delete/'.$upload->id);?>">Delete</a></li>

<?php endforeach; ?>
</ul>

<p>Classifieds</p>
<ul>
<?php foreach($allclassifieds as $classified): ?>

	<li><?php echo $classified->title ?> <a href="<?php echo site_url('classifieds/delete/'.$classified->id);?>">Delete</a></li>

<?php endforeach; ?>
</ul>