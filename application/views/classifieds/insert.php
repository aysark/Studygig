<div class="twoCol1">
	<h1>List Your Books & Study Material</h1>
	
	<?php if ( isset($error)) {
			
		echo '<div class="ui-state-error ui-corner-all" style="padding-top: 0px; padding-right: 0.7em; padding-bottom: 0px; padding-left: 0.7em;color:#CD0A0A; width:90%;">'.$error.'</div>';
		}?>
		<?php if (validation_errors() != ""){
			 echo '<div class="ui-state-error ui-corner-all" style="padding-top: 0px; padding-right: 0.7em; padding-bottom: 0px; padding-left: 0.7em;color:#CD0A0A; width:90%;">'.validation_errors().'</div>';
			} ?>
	

	
	
	<?php 
		$attributes = array('id' => 'sellform');
		echo form_open_multipart('classifieds/add',$attributes); 
	?>
	
	<div id="insertMaterialType">
		<h2>What kind of study material are you selling? <a href="#" class="dashHelp" title="This helps us keep everything nice and tidy."><img src="../../images/help-icon.gif" width="16" height="15" alt="Help Icon" /></a><span class="formDesc">Required. </span></h2>
				<select id="material" size="5" name="material" tabindex="1" required>
		<option value="7" <?php echo set_select('material', '7'); ?>>Book</option>
		<option value="1" <?php echo set_select('material', '1'); ?>>Test Package (quizes, tests, midterms, exams, etc.)</option>
		<option value="2" <?php echo set_select('material', '2'); ?>>Note Package (notes, study guides, reference material, labs, etc.)</option>
		<option value="8" <?php echo set_select('material', '8'); ?>>All-in-one Package (book, test package, note package)</option>
		<option value="6" <?php echo set_select('material', '6'); ?>>Other</option>
	</select>		
	<div class="clear"></div>

	

	
	<div id="insertSelectSubject">
		<h2>Select Subject <a href="#" class="dashHelp" title="The subject your study material is for (and then the course)."><img src="../../images/help-icon.gif" width="16" height="15" alt="Help Icon" /></a><span class="formDesc">Required.</span></h2>
			<select id="subject_id"  size="10" name="subject_id" class="chzn-select1" title="Choose a Subject..." tabindex="2"  >
			<?php foreach($subjects as $subject): ?>
		
				<option value="<?php echo $subject->id; ?>"  <?php echo set_select('subject_id',  $subject->id); ?>><?php echo $subject->title; ?></option>
		
			<?php endforeach; ?>
		</select>
		
		<div id="courses_select">
		<select id="course_id" size="10" name="course_id"  class="chzn-select2" title="Choose a Course..." tabindex="3">
			</select>
		</div>
		
	</div>


	
	<div id="insertUTitleDesc">
		<h2>Describe your study material <a href="#" class="dashHelp" title="The more details your write, the easier it will be to find and the more points you'll earn!"><img src="../../images/help-icon.gif" width="16" height="15" alt="Help Icon" /></a><span class="formDesc">Required. </span></h2>	
				
			<div class="insertCol1">
	Title<input type="textfield" id="insertTitle" name="title" maxlength="60" value="<?php echo set_value('title'); ?>" tabindex="4" placeholder="eg. Microeconomics (7th Edition)" required />
	<br/>
	Price ($)<input type="textfield" id="insertPrice" name="price" maxlength="30" value="<?php echo set_value('price'); ?>" tabindex="5" placeholder="100" required />
	</div>
	<div class="insertCol2">
			<div id="descriptionSlideOut2" style="display:none;"> 
        <b>Include in your description:</b>
        <ul class="guidelines"><li>For books: ISBN, title, author, edition</li>
        	<li>Condition of material</li>
        	<li>Material description (what it includes, how it will help, etc.)</li>
        	<li>Additional contact info (eg. phone number)</li>
        </ul>
      </div> 
	Description
	<textarea id="insertDescription" name="description" rows="5" cols="30" tabindex="6" onKeyDown="limitText(this.form.description,this.form.countdown,500);" 
onKeyUp="limitText(this.form.description,this.form.countdown,500);" required ></textarea>
(Maximum characters: 500)
</div>
	</div>
	
	<div id="postfb">
		
		<p> 
			<h2>Would you like to tell your friends on Facebook? <a href="#" class="dashHelp" title="It helps promote your stuff to get you points! This only posts to your wall once, we will never use it for spam- pwomise!"><img src="../../images/help-icon.gif" width="16" height="15" alt="Help Icon" /></a><span class="formDesc">Optional.</span></h2>
		<label><input type="checkbox" name="postfb" id="postfb" value="1" tabindex="7" /> I would like to make a Facebook post.</label>
		</p>
	</div>
	
<input type="submit" value="List Study Material" id="insertUploadButton" tabindex="8"/> 
<?php echo form_close(); ?>
	
	</div>
	</div>
<div class="twoCol2">

	<div class="roundedCornerContent">
        <span class="blueh2">How it works</span>
        <ol class="insertHowIt">
        	<li><b>List your books and study material</b> — you can list books or any type of study material that helped you study.</li>
        	<li><b>Connect with students</b> — your post will be listed in the search results of that course.  You will then be contacted by students who want to buy your stuff.</li>
        	<li><b>Save up to 100%</b> — you can meet with students at your leisure and sell your stuff to earn back the money you may of spent on it!</li>
        	</ol>
        	
        	<span class="blueh2">Guidelines to posting</span>
        <ul class="guidelines">
        	<li>Be as descriptive as possible; mention the year and term the study material was for, the professor at that time, the ISBN of the book (if you are selling a book) etc.</li>
        	<li>Solutions are far better than questions!  No point in selling an assignment without its solutions!</li>  
        	<li>Your email address is kept private and users will use a contact form to contact you.  If you'd like to be contacted faster, you can provide more contact details in the description section.</li>       	
        </ul>
            
    </div>	
	</div>



<script src="<?php echo base_url();?>js/chosen.jquery.js" type="text/javascript"></script>

<script type="text/javascript" >

$(document).ready(function(){
	
	$(".radioKinds").click(function() {
		var $buttonTitle = $(this).attr('title');
				
		// clear all radio bttns
		$('input[class=noRadio]:checked').removeAttr('checked');
		$("#kind1").css('background-position','left top');
		$("#kind2").css('background-position','-78px 0px');
		
		if ($buttonTitle == 1){
	   		$("#kind1").css('background-position','left bottom');
	    }else{
	    	$("#kind2").css('background-position','-78px -78px');
	    }
	   	//alert($buttonTitle);
	   $('#materialKinds').children().find("#kind"+$buttonTitle).find(":radio").attr('checked','checked');
		//$('#materialKinds').children().find("#kind"+$buttonTitle).css('background-position','0px 0px');
		alert($("input[name=radioKind1]","#materialKinds").val());
	});
	
	$(".chzn-select1").chosen();
	$(".chzn-select2").chosen();
  $("#subject_id").change( 
		
		function (){
			$("#courses_select").css("visibility","visible");
			var url = '<?php echo site_url('uploads/getcourse/') ?>/';
			var subject_id = $(".chzn-select1").val();
		
			$.post(url , { 'subject_id' : subject_id }, function(data) {
			
			var courses = '';
			for (var key in data) {
		  	courses += '<option value="' + data[key].id + '" <?php echo set_select("course_id", "'+ data[key].id +'"); ?>>' + data[key].course_title + '</option>';
		  }								
		    
		    
			$("#course_id").html(courses);
			$(".chzn-select2").trigger("liszt:updated");
			},'json');
			
		}
	);
	
	
    
    $("#insertTitle").click(function() {
    if ($("#insertTitle").val() == "eg. Microeconomics (7th Edition)" ){
    	$("#insertTitle").attr('value', '');
    	$("#insertTitle").css('color','#000000');
    }
	});
	
	$(".insertCol2 textarea").focus(function() {
            $('#descriptionSlideOut2').effect('slide', 'fast');
            });
            $("#insertDescription").blur(function() {
              $('#descriptionSlideOut2').css('display', 'none');
    });
 
	$('.dashHelp').tipsy({gravity: 'w'});
});	 	

function limitText(limitField, limitCount, limitNum) {
	if (limitField.value.length > limitNum) {
		limitField.value = limitField.value.substring(0, limitNum);
	} else {
		limitCount.value = limitNum - limitField.value.length;
	}
} 

</script>
