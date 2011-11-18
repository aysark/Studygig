<div class="roundedCornerContent silver" style="text-align:center;">
	
	<h1>Invite Your Friends & Classmates</h1>
	
	<div id="inviteOffer">
		<div id="friendsPic"></div>
		<div id="equals"></div>
		<div id="pointCredit"></div>
	</div>
	
	<p id="inviteOfferText">You'll get $10 when they sign up for a member plan and $10 when they make 30 uploads.</p>
	<div class="clear"></div>
	
	<div id="inviteAction">
		
		Get Started » <span id="insertUploadButton" style="font-size:18px;vertical-align:middle;">Email Your Friends</span>
		<div id="ratingFeedback" class="ui-corner-all" ></div>
		<div id="emailClassmatesDialog" title="Email Your Classmates & Friends">
		<h2>To</h2>
		<input type="textfield" class="formTextField" name="email1" value="" placeholder="friend@example.com" required />
		<input type="textfield" class="formTextField" name="email2" value="" placeholder="friend@example.com" />
		<input type="textfield" class="formTextField" name="email3" value="" placeholder="friend@example.com" />
		+ Add Another Friend
		<h2>Message</h2>
		<textarea rows="5" cols="5" name="message" id="insertDescription" style="width:90%" required>I've been uploading my notes on Studygig so I can download course study material like past tests and study guides.  It has made my studying so much easier and i'm getting better marks.  It's a really cool site you should try it.  Cheers! <?php echo $user->username; ?></textarea>
	</div>
		
	</div>
</div>

<script type="text/javascript" language="JavaScript">
$(function() {
	var emailsToInvite = $('input[name="email1"]');
	var messageToInvites = $("#insertDescription");
	$( "#emailClassmatesDialog" ).dialog({
			autoOpen: false,
			height: 550,
			width: 550,
			modal: true,
			buttons: {
				"Send Invites": function() {
							
					var bValid = true;
					bValid = bValid && (messageToInvites.val() !=0) && (emailsToInvite.val()!= 0);
					
					if ( bValid ) {		
						emailsToInvite = "";
						var i;
						for (i=0; i<3;i++)
						{
							emailsToInvite += $('input[name="email"'+i+']')+',';
						}			
						alert(emailsToInvite);	
						$.post( "<?php echo site_url('users/sendInvites');?>", {emails:emailsToInvite , message: messageToInvites.val()},
					      function( data ) {
					      	 $("#ratingFeedback").css("visibility","visible");
					      	document.getElementById("ratingFeedback").innerHTML=data;
					      }
					    );
						$( this ).dialog( "close" );
					}
				},
				Cancel: function() {
					$( this ).dialog( "close" );
				}
			},
			close: function() {
				allFields.val( "" ).removeClass( "ui-state-error" );
			}

		});
	$( "#insertUploadButton" )	.click(function() {
				$( "#emailClassmatesDialog" ).dialog( "open" );
			});
});
</script>