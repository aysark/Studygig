<div id="content2">
	
	<div id="aboutUsBanner">
	</div>
<div class="twoCol1RightBased">	
	<?php include('aboutUsNav.php');?>
</div>
<div class="twoCol2RightBased">
	<div class="roundedCornerContent" id="siteAnchor">
		
	<h1>We'd love to hear from you!</h1>
<?php if ($editted==1){
	echo '<p class="ui-state-highlight ui-corner-all" style="padding-top: 0px; padding-right: 0.7em; padding-bottom: 0px; padding-left: 0.7em;">Success! Your message was sent.  We\'ll get back to you as soon as we can!</p>';
	}else if (validation_errors() != ""){
		echo '<div class="ui-state-error ui-corner-all" style="padding-top: 0px; padding-right: 0.7em; padding-bottom: 0px; padding-left: 0.7em;color:#CD0A0A; width:90%;">'.validation_errors().'</div>'; } 
		?>

<h3>Were you looking for the <a href="http://studygig.assistly.com/">help section?</a></h3>
<div id="editProfileForm">
<?php echo form_open('site/contact');?>
Category:
<br/>
<select name="category" class="formTextField">
	<option value="0">Select a Category</option>
	<option value="1">Feedback & Suggestions</option>
	<option value="2">Help</option>
	<option value="3">Technical Support</option>
	<option value="4">Other (please specify)</option>
</select>
<br/>
Message:
<br/>
<textarea rows="5" cols="50" name="message" id="insertDescription" style="width:50%;" value="<?php echo set_value('message'); ?>">
</textarea>
<br/>
Name: 
<input type="textfield" class="formTextField" name="name" value="<?php echo set_value('name'); ?>" />
<br/>
Email: 
<input type="textfield" class="formTextField" name="email" maxlength="30" value="<?php echo set_value('email'); ?>" />



<input type="submit" id="insertUploadButton"  name="submit" value="Send" /> 
<?php echo form_close();?>
</div>

</div>
</div>

</div>
