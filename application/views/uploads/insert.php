	<script type="text/javascript" src="<?php echo base_url();?>js/jquery.MultiFile.min.js"></script>	
  
<div id="content2">
<div class="twoCol1">
	<h1>Share Study Material</h1>
	
	<?php if ( isset($error)) {
			
		echo '<div class="ui-state-error ui-corner-all" style="padding-top: 0px; padding-right: 0.7em; padding-bottom: 0px; padding-left: 0.7em;color:#CD0A0A; width:90%;">'.$error.'</div>';
		}?>
		<?php if (validation_errors() != ""){
			 echo '<div class="ui-state-error ui-corner-all" style="padding-top: 0px; padding-right: 0.7em; padding-bottom: 0px; padding-left: 0.7em;color:#CD0A0A; width:90%;">'.validation_errors().'</div>';
			} ?>
	

	
	
	<?php 
		$attributes = array('id' => 'uploadform');
		echo form_open_multipart('uploads/upload',$attributes); 
	?>
		
	<div id="insertUploadType">
		<h2>How would you like to Share?<span class="formDesc">Required. You can upload from your computer or share a link from the web.  You can only upload Word, PowerPoint, PDF, or image files (eg. scanned papers).</span></h2>	
		<label class="uploadTypeRadio"><input type="radio" name="uploadType"  value="u" tabindex="1"/> Upload file(s)  </label>
	   <label class="uploadTypeRadio"> <input type="radio" name="uploadType"  value="l"  /> Direct website link to file (http://...)</label>
		        <div id="u" class="uploadTypeField">
		    	 <p>Select file(s) (must be in PDF, PPT, DOC, DOCX, JPEG/JPG, PNG or GIF format, max file size: 50 MB):</p>
		<input type="file" name="userfile[]" size="200" class="multi" accept="docx|pdf|doc|ppt|pptx|gif|jpg|jpeg|png"  maxlength="10" />
		    </div>
		<div id="l" class="uploadTypeField">
		    	 <p>Enter URL (the url must start with '<b>http://</b>' and end with .PDF, .PPT, .DOC, .DOCX, .JPEG/.JPG, .PNG or .GIF):</p>
		<input type="textfield" name="uploadLink" size="75" id="insertURL" value="<?php echo set_value('uploadLink',"eg. http://www.myProfessorSite.com/assignment1Solutions.pdf"); ?>"/>
		    </div>
	</div>
	
	<div id="insertSelectSubject">
		<h2>Select Material's Subject <span class="formDesc">Required. The subject your study material is for (and then the course).</span></h2>
			<select id="subject_id"  size="10" name="subject_id" class="chzn-select1" title="Choose a Subject..." tabindex="2" >
			<?php foreach($subjects as $subject): ?>
		
				<option value="<?php echo $subject->id; ?>"  <?php echo set_select('subject_id',  $subject->id); ?>><?php echo $subject->title; ?></option>
		
			<?php endforeach; ?>
		</select>
		
			<input type="hidden" id="user_id" name="user_id" value="<?php echo $this->session->userdata('user_id');?>" />
		<div id="courses_select">
		<select id="course_id" size="10" name="course_id"  class="chzn-select2" title="Choose a Course..." tabindex="3">
			</select>
		</div>
	</div>
	
	<div id="insertMaterialType">
		<h2>What kind of study material are you sharing?<span class="formDesc">Required. This helps us keep everything nice and tidy.</span></h2>
				<select id="material" size="7" name="material" tabindex="4">
		<option value="0" <?php echo set_select('material', '0'); ?>>Quiz/Test/Midterm/Exam</option>
		<option value="1" <?php echo set_select('material', '1'); ?>>Assignment/Solutions</option>
		<option value="2" <?php echo set_select('material', '2'); ?>>Study Guide</option>
		<option value="3" <?php echo set_select('material', '3'); ?>>Reference Material/Equation Sheet</option>
		<option value="4" <?php echo set_select('material', '4'); ?>>Lab Material/Report</option>
		<option value="5" <?php echo set_select('material', '5'); ?>>Lecture Notes</option>
		<option value="6" <?php echo set_select('material', '6'); ?>>Other</option>
	</select>		
	<div id="material0" class="materialType ui-state-highlight ui-corner-all">
Earn <b>20 points</b> for uploading a quiz/test/midterm/exam/final or <b>15 points</b> for a link.
</div>
<div id="material1" class="materialType ui-state-highlight ui-corner-all">
Earn <b>15 points</b> for uploading solutions to an assignment or <b>5 points</b> for a link.
</div>
<div id="material2" class="materialType ui-state-highlight ui-corner-all">
Earn <b>10 points</b> for uploading a study guide or <b>5 points</b> for a link.
</div>
<div id="material3" class="materialType ui-state-highlight ui-corner-all">
Earn <b>5 points</b> for uploading reference/equation/formula/cheat sheet or <b>3 points</b> for a link.
</div>
<div id="material4" class="materialType ui-state-highlight ui-corner-all">
Earn <b>5 points</b> for uploading a lab related material or <b>3 points</b> for a link.
</div>
<div id="material5" class="materialType ui-state-highlight ui-corner-all">
Earn <b>5 points</b> for uploading notes or <b>3 points</b> for a link.
</div>
<div id="material6" class="materialType ui-state-highlight ui-corner-all">
Earn <b>1 point</b> for uploading or linking other helpful study material not categorized in the above.
</div>
	</div>
	
	<div id="insertUTitleDesc">
		<h2>Describe your study material<span class="formDesc">Required. The more details your write, the easier it will be to find and the more points you'll earn!</span></h2>	
				
			<div class="insertCol1">
	Title<input type="textfield" id="insertTitle" name="title" maxlength="60" value="<?php echo set_value('title',"eg. Midterm Fall 2008 Prof Albert"); ?>" tabindex="5" /> 
	<p class="smallText"><b>Examples of good titles:</b><br/>
		F09 Midterm 1<br/>
		Lecture 8 Notes - Business Management<br/>
		Assignment 4 w/ Solutions<br/>
		Textbook Chapter Summaries (1-4)<br/>
	</p>
	</div>
	<div class="insertCol2">
		<div id="descriptionSlideOut" style="display:none;"> 
        <b>Include in your description:</b>
        <ul class="guidelines"><li>Year & term study material was used for (ie. 2008 Fall)</li>
        	<li>Professor's/Instructor's name</li>
        	<li>Material description (what it includes, how it will help, etc.)</li>
        	The more downloads the more points you get (2 pts/download)
        </ul>
      </div> 
	Description
	<textarea id="insertDescription" name="description" rows="5" cols="30" onKeyDown="limitText(this.form.description,this.form.countdown,350);" 
onKeyUp="limitText(this.form.description,this.form.countdown,350);" tabindex="6"></textarea>
(Maximum characters: 350)
</div>

	</div>
	
	<div id="insertKeywords">
		<h2>Add tags<span class="formDesc">Optional. These help make your study material more relevant and search-friendly.</span></h2>
		
		<select title="Type generic words that describe your post..." class="chzn-select3" multiple style="width:600px;" tabindex="7" name="tags[]" id="multi_example">
          <option value="Answers">Answers</option> 
          <option value="Assignment">Assignment</option> 
          <option value="Books">Books</option> 
          <option value="Chapter">Chapter</option> 
          <option value="Essay">Essay</option> 
          <option value="Exam">Exam</option> 
          <option value="Formula Sheet">Formula Sheet</option> 
          <option value="Lecture">Lecture</option> 
          <option value="Manual">Manual</option> 
          <option value="Midterm">Midterm</option> 
          <option value="Presentation">Presentation</option> 
          <option value="Problem Set">Problem Set</option> 
          <option value="Project">Project</option> 
          <option value="Questions">Questions</option> 
          <option value="Quiz">Quiz</option> 
          <option value="Reading">Reading</option> 
          <option value="Report">Report</option> 
          <option value="Review">Review</option> 
          <option value="Section">Section</option>
          <option value="Solutions">Solutions</option> 
          <option value="Statistics">Statistics</option> 
          <option value="Summary">Summary</option>
          <option value="Syllabus">Syllabus</option>
          <option value="Test">Test</option>
          <option value="Textbook">Textbook</option>
          <option value="Tutorial">Tutorial</option>
        </select>
		
	</div>
	
	<div id="insertAnon">
		<h2>Would you like to share anonymously?<span class="formDesc">Optional.</span></h2>
		<label><input type="checkbox" name="anon" value="1" /> I would like to make this post anonymously.</label>
	</div>
	
	<div id="postfb">
		<h2>Would you like to tell your friends on Facebook?<span class="formDesc">Optional. But it helps promote your stuff to get you points!</span></h2>
		<label><input type="checkbox" name="postfb" id="postfb" value="1" /> I would like to make a Facebook post.</label>
	</div>
	
	<p>By uploading a file you certify that you have the right to distribute it and that it does not violate the Terms of Use.</p>
	
<input type="submit" value="Post Study Material" id="insertUploadButton" /> 
<?php echo form_close(); ?>
	
	</div>
	<div class="twoCol2">
	<div class="roundedCornerContent">
        <h1>Post Material. Earn Points. Get Rewarded!</h1>
        <span class="blueh2">How it works</span>
        <ol class="insertHowIt">
        	<li><b>Post study material</b> — you can post your own study material or helpful study material that you found.</li>
        	<li><b>Earn points</b> — you earn points whenever you share, rate, or even login (once a day).  Points can be used to download study material or...</li>
        	<li><b>Redeem your rewards</b> — trade in your points for Best Buy, iTunes, and Amazon gift cards!</li>
        	</ol>
        	
        	<span class="blueh2">Guidelines to posting</span>
        <ul class="guidelines">
        	<li>Share useful material- that means if you didn't use it to study, chances are not many people will. <b> You also get 2 points everytime someone downloads your study material so sharing quality material helps you in the long run!</b></li>
        	<li>Be as descriptive as possible; mention the year and term the study material was for, the professor at that time, etc.</li>
        	<li>Solutions are far better than questions!  No point in posting an assignment without its solutions!</li>
        	<li>We encourage .PDF and image formats as uploads, currently those are the only formats we provide previews for.</li>
        	
        </ul>
            
    </div>
    
</div>
</div>

<script src="<?php echo base_url();?>js/chosen.jquery.js" type="text/javascript"></script>
  
<script type="text/javascript" >

$(document).ready(function(){
	$(".chzn-select1").chosen();
	$(".chzn-select2").chosen();
	$(".chzn-select3").chosen();
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
	
	$(".tag").click(function () {
      var text = $(this).val();
      var desc = $("#insertDescription").val();
      $("#insertDescription").val(desc+text);
      $(this).hide();
    });
	
	$(".insertCol2 textarea").focus(function() {
            $('#descriptionSlideOut').effect('slide', 'fast');
            });
            $("#insertDescription").blur(function() {
              $('#descriptionSlideOut').css('display', 'none');
    });
    
    $("#insertURL").click(function() {
    	if ($("#insertURL").val() == "eg. http://www.myProfessorSite.com/assignment1Solutions.pdf" ){
    	$("#insertURL").attr('value', '');
    	$("#insertURL").css('color','#000000');
	}
	});
    
    $("#insertTitle").click(function() {
    if ($("#insertTitle").val() == "eg. Midterm Fall 2008 Prof Albert" ){
    	$("#insertTitle").attr('value', '');
    	$("#insertTitle").css('color','#000000');
    }
	});

	$("input[name='uploadType']").change(function() {
        var test = $(this).val();
        $("div.uploadTypeField").hide();
       	 $("#"+test).show();
       	 
       	 if (test == "u"){
       	 	$("input:radio[name='uploadType'][value='u']").prop("checked", true);
       	 	$("input:radio[name='uploadType'][value='l']").prop("checked", false);
       	 }else{
       	 	$("input:radio[name='uploadType'][value='l']").prop("checked", true);
       	 	$("input:radio[name='uploadType'][value='u']").prop("checked", false);
       	 }
    });
    
    $("select[name='material']").change(function() {
        var test = $(this).val();
        $("div.materialType").hide();
       	 $("#material"+test).show();
       	 
    });
    
 
	
});	 	

function limitText(limitField, limitCount, limitNum) {
	if (limitField.value.length > limitNum) {
		limitField.value = limitField.value.substring(0, limitNum);
	} else {
		limitCount.value = limitNum - limitField.value.length;
	}
}

  

</script>
