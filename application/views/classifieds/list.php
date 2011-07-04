<h1>Classifieds</h1>

<?php foreach($classifieds as $c): ?>
	<p><?=$c->title?> priced $<?=$c->price?></p> 
<?php endforeach;?>
