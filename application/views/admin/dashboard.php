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
		<li><a href="#tabs-6">Server</a></li>
		<li><a href="#tabs-7">Email Marketing</a></li>

	</ul>
	<div id="tabs-1"> <!-- QUICK UPLOAD -->
		
		<h2>Latest</h2>
		<a href="moderators/insert">Click here to upload</a>	
		<div id="seperatorAdmin">
  	</div>
		<h2>Server</h2>
		<img src="http://share.pingdom.com/banners/9e0fe063"  alt="Uptime for Studygig Main: Last 30 days " title=" Uptime for Studygig Main: Last 30 days" width="300" height="165" />
		<img src="http://share.pingdom.com/banners/00398017"  alt="Response time for Studygig Main: Last 30 days " title=" Response time for Studygig Main: Last 30 days" width="300" height="165" />
		<br>
		<a href="http://stats.pingdom.com/776aaa33aur2/383783">Detailed public Pingdom report</a>
	
	</div>
	<div id="tabs-2"> <!-- USERS DATA -->
	<table cellpadding="0" cellspacing="0" border="0" class="display" id="usersTable">
	<thead> 
		<tr> 
			<th>ID</th> 
			<th>Username</th> 
			<th>Joined</th> 
			<th>Points</th> 
			<th>Facebook</th> 
		</tr> 
	</thead> 
	<tbody> 
		<?php
		foreach($all_users as $user) {
			
			if(isset($user->oauth_provider))
				$facebook='true';
			else
				$facebook='';
				
			if ( $user->verified == 0 ) {
				echo '<tr class="gradeX">';
			}else{
				echo '<tr class="gradeA"> ';
			}
			echo '<td>'.$user->id.'</td>'.'<td>'. $user->username.'</td>'.'<td>'.$user->joined.'</td>'.'<td>'.$user->points.'</td>'.'<td>'. $facebook.'</td>';
			echo '</tr>';
		}
		?>
	</tbody>
</table>
	
	</div>
	<div id="tabs-3"> <!-- UPLOADS DATA -->
		
		<p>Uploads awaiting moderation: </p>
		<form method="post" action="<?php echo site_url('admin/decide'); ?>">
			<table cellpadding="0" cellspacing="0" border="0" class="display" id="sharedPostsTable">
				<thead> 
					<tr> 
						<th>Title</th> 
						<th>Views</th> 
						<th>Favourites</th>  
						<th>Created</th> 
					</tr> 
				</thead> 
				<tbody>
				<?php foreach ($inactive_uploads as $u): ?>
					<tr>
					<td><input type="checkbox" name="uploads[]" value="<?php echo $u->id; ?>" /><a href="<?php echo site_url('admin/view/'.$u->id);?>"><?php echo $u->title;?></a></td>
					<td><?php echo $u->views; ?></td>
					<td><?php echo $u->favourites; ?></td>
					<td><?php echo $u->created_at; ?></td>
					</tr>
				<?php endforeach;?>
			</tbody>
</table>
			<input type="submit" value="Approve selected" id="approve" name="approve" /> <input type="submit" value="Reject selected" id="reject" name="reject" />
			<input type="hidden" id="classifieds" value="0" />
		</form>
	</div>
	<div id="tabs-4"> <!-- CLASSIFIEDS DATA -->

		<p>Classifieds awaiting moderation: </p>
		<form method="post" action="<?php echo site_url('admin/decide'); ?>">
			<table cellpadding="0" cellspacing="0" border="0" class="display" id="classifiedsTable">
				<thead> 
					<tr> 
						<th>Title</th> 
						<th>Views</th> 
						<th>Created</th> 
					</tr> 
				</thead> 
				<tbody>
				<?php foreach ($inactive_classifieds as $c): ?>
					<tr>
					<td><input type="checkbox" name="classifieds[]" value="<?php echo $c->id; ?>" /><a href="<?php echo site_url('admin/view/'.$c->id);?>"><?php echo $c->title;?></a></td>
					<td><?php echo $c->views; ?></td>				
					<td><?php echo $c->created_at; ?></td>
					</tr>
				<?php endforeach;?>
			</tbody>
</table>
			<input type="submit" value="Approve selected" id="approve" name="approve" /> <input type="submit" value="Reject selected" id="reject" name="reject" />
			<input type="hidden" id="classifieds" value="1" />
		</form>

	</div>
	<div id="tabs-5"> <!-- FLAGS DATA -->
		<?php if ($flags): ?>
	<table cellpadding="0" cellspacing="0" border="0" class="display" id="flagsTable">
	<thead> 
		<tr> 
			<th>Reason</th> 
			<th>User</th> 
			<th>Upload ID</th> 
			<th>Date submitted</th> 
			<th>Comments</th> 
		</tr> 
	</thead> 
	<tbody> 
			<?php
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
				echo '<tr>';
				echo '<td>'.$reason.'</td><td><a href="'.site_url('admin/viewuser/'. $flag->user_id).'">View user</a></td><td><a href="'. site_url('admin/view/'. $flag->upload_id).'">View upload</a></td><td>'.$flag->date.'</td><td>'.$flag->comments.'</td>';
				echo '</tr>';
			}
			?>
</tbody>
</table>
		
		<?php else:?>
			<p>No flags!</p>
		<?php endif?>
	</div>
	<div id="tabs-6"> <!-- SERVER DATA -->
		<iframe src="https://rpm.newrelic.com/public/charts/hnhwAZAD3DM" width="850" height="470" scrolling="yes" frameborder="no"></iframe>
		
		<iframe src="https://rpm.newrelic.com/public/charts/7UBzQQjatkj" width="850" height="470" scrolling="yes" frameborder="no"></iframe>
	</div>
	
	<div id="tabs-7"> <!-- EMAIL MARKETING DATA -->
		<b>If you were not told to use this - do not use it.  This is for email tracking analytics only.</b>
		<form action="moderators/emailmarket" method="post" name="email" id="emailForm" />
	<p><input type="textfield" id="fromName" name="fromName" value="John S." required /></p>
	<p><input type="textfield" id="fromEmail" name="fromEmail" value="john.sheen09@gmail.com" required /></p>
	<p><input type="textfield" id="to" name="to" placeholder="To" required  onClick="SelectAll('to');"/></p>
	<p><input type="textfield" id="subject" name="subject" placeholder="Subject" required /></p>
	<label><input type="radio" name="uploadType" value="b" />Regarding book</label><label><input type="radio" name="uploadType" value="n" />Regarding notes</label>
	<p><textarea rows="12" cols="130" id="insertMessage" name="message" placeholder="Message" required></textarea></p>
	<p><input type="submit" value="Send"  onclick="signupEmailUni()" /></p>
	<div id="ratingFeedback" class="ui-corner-all" style="padding-top: 0px; padding-right: 0.3em; padding-bottom: 0px; padding-left: 0.3em;" ></div>
</form>
		
	</div>
</div>



<!-- <ul>
<?foreach ($stats['queries'] as $q):?>
<li><?=$q->query?> - <?=$q->ip?></li>
<?endforeach;?>
</ul> -->
</div>

<script type="text/javascript" language="JavaScript">
 $(function() {
 		$( "#tabs" ).tabs();
		$('#usersTable').dataTable( {
		"aaSorting": [[ 2, "desc" ]],
		"aoColumns": [
			null,
			null,
			null,
			null,
			null
		],
		"sDom": '<"top"i>rt<"bottom"flp><"clear">',
		"sPaginationType": "full_numbers"	
	 } );
	 
	 $('#sharedPostsTable').dataTable( {
		"aaSorting": [[ 3, "asc" ]],
		"aoColumns": [
			null,
			null,
			null,
			null
		],
		"sDom": '<"top"i>rt<"bottom"flp><"clear">',
		"sPaginationType": "full_numbers"	
	 } );
	$('#classifiedsTable').dataTable( {
		"aaSorting": [[ 2, "asc" ]],
		"aoColumns": [
			null,
			null,
			null
		],
		"sDom": '<"top"i>rt<"bottom"flp><"clear">',
		"sPaginationType": "full_numbers"	
	 } );
	$('#flagsTable').dataTable( {
		"aaSorting": [[ 3, "asc" ]],
		"aoColumns": [
			null,
			null,
			null,
			null,
			null
		],
		"sDom": '<"top"i>rt<"bottom"flp><"clear">',
		"sPaginationType": "full_numbers"	
	 } );
	 
	 $("input[name='uploadType']").change(function() {
        var test = $(this).val();
       	 
       	 if (test == "b"){
       	
       	 	$("#insertMessage").val("Hi, <br><br>I was wondering if you are still selling your book because i wanted to share with you a new site for YorkU students to share, list and find books and study material.  Tons of students are registering on the site (especially first years) looking for books and study material- you might just sell your book sooner than you think! <br><br>Check it out at: <a href='http://studygig.com'>http://www.studygig.com</a> <br><br>Best of luck, <br>John S.");
       	 }else{
       	 	$("#insertMessage").val("Hi, <br><br>I was wondering if you are still giving away your notes because i wanted to share with you a new site for YorkU students to share, list and find study material such as your notes.  You get rewarded for every note your share, you can earn $1 for every 4 notes you share or 2 past tests - given in gift cards such as BestBuy, iTunes and Amazon. <br><br>Tons of students are registering on the site (especially first years) looking for study material- when they download your notes, you'll get rewarded too! <br><br>Check it out at: <a href='http://studygig.com'>http://www.studygig.com</a> <br><br>Best of luck,<br>John S.");
       	 }
    });
	} );
	
function signupEmailUni(){
  	/* attach a submit handler to the form */
  $("#emailForm").submit(function(event) {
    /* stop form from submitting normally */
    event.preventDefault(); 
  });
  	 $("#ratingFeedback").html('loading...');  
	 /* Send the data using post and put the results in a div */
    $.post( "<?php echo site_url('admin/moderators/emailmarket');?>", { to: $("#to").val(), 
    				 message: $("#insertMessage").val(), 
    				  fromEmail: $("#fromEmail").val(), 
    				   fromName: $("#fromName").val(), 
    				    subject: $("#subject").val()
    },
      function( data ) {
      	$("#ratingFeedback").css({'visibility' : 'visible', 'background-color' : '#fbec88', 'color':'#363636','margin-bottom':'5px','border':'1px solid #fad42e'}	);
      	document.getElementById("ratingFeedback").innerHTML=data;
      }
    );
}

  function SelectAll(id)
{
    document.getElementById(id).focus();
    document.getElementById(id).select();
}
</script>