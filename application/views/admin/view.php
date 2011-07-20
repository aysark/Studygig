<h1> <?php echo $upload->title;?> </h1>

<p>Uploaded on <?=$upload->created_at?></p>
<p><?=$upload->description?></p>
<iframe src="http://docs.google.com/gview?url=<?php echo $upload->filepath; ?>&embedded=true" style="width:650px; height:730px;" frameborder="0"></iframe>
