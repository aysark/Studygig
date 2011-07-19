<script type="text/javascript" src="../../../js/swfupload/swfupload.js"></script>
<script type="text/javascript" src="../../../js/swfupload.queue.js"></script>
<script type="text/javascript" src="../../../js/fileprogress.js"></script>
<script type="text/javascript" src="../../../js/handlers.js"></script>

<script type="text/javascript">
		var swfu;

		window.onload = function() {
			var settings = {
				flash_url : "../../../js/swfupload/swfupload.swf",
				upload_url: "../../../fileUpload.php",
				post_params: {"upload" : true},
				file_size_limit : "100 MB",
				file_types : "*.docx;*.pdf;*.doc;*.ppt;*.pptx;*.gif;*.jpg;*.jpeg;*.png",
				file_types_description : "PDF|DOC|PPT|IMAGES",
				file_upload_limit : 0,
				file_queue_limit : 0,
				custom_settings : {
					progressTarget : "fsUploadProgress",
					cancelButtonId : "btnCancel"
				},
				debug: true,

				// Button settings
				button_image_url: "../../../css/images/TestImageNoText_65x29.png",
				button_width: "65",
				button_height: "29",
				button_placeholder_id: "spanButtonPlaceHolder",
				button_text: '<span class="theFont">Browse</span>',
				button_text_style: ".theFont { font-size: 16; }",
				button_text_left_padding: 10,
				button_text_top_padding: 3,
				
				// The event handler functions are defined in handlers.js
				file_queued_handler : fileQueued,
				file_queue_error_handler : fileQueueError,
				file_dialog_complete_handler : fileDialogComplete,
				//upload_start_handler : uploadStart,
				upload_progress_handler : uploadProgress,
				upload_error_handler : uploadError,
				upload_success_handler : uploadSuccess,
				upload_complete_handler : uploadComplete,
				queue_complete_handler : queueComplete	// Queue plugin event
			};

			swfu = new SWFUpload(settings);
	     };
	</script>

<div id="content2">
<div class="twoCol1">
	<a href="../">< Back to Admin Panel</a>

		<?php if (validation_errors() != ""){
			 echo '<div class="ui-state-error ui-corner-all" style="padding-top: 0px; padding-right: 0.7em; padding-bottom: 0px; padding-left: 0.7em;color:#CD0A0A; width:90%;">'.validation_errors().'</div>';
			} ?>
	

	
	<?php 
		$attributes = array('id' => 'uploadform');
		echo form_open_multipart('admin/moderators/upload',$attributes); 
	?>
		
	<div id="insertUploadType">
		<h2>Study Material Uploader<span class="formDesc">Required. You can upload from your computer or share a link from the web.  You can only upload Word, PowerPoint, PDF, or image files (eg. scanned papers).</span></h2>	
		    
		    	 <p>Select file(s) (must be in PDF, PPT, DOC, DOCX, JPEG/JPG, PNG or GIF format, <b>max file size: 50 MB</b>) - note you need flash 9+ to use it, so be sure to get <a href="http://www.adobe.com/products/flashplayer/">here</a>:</p>

<div>
				<span id="spanButtonPlaceHolder"></span>
				<input id="btnCancel" type="button" value="Cancel All Uploads" onclick="swfu.cancelQueue();" disabled="disabled" style="margin-left: 2px; font-size: 8pt; height: 29px;" />

			</div>
		    <div class="fieldset flash" id="fsUploadProgress">
			<span class="legend">Upload Queue</span>
			</div>
		<div id="divStatus">0 Files Uploaded</div>
		<input type="hidden" name="hidFileID" id="hidFileID" value="" />
	</div>
	
	<div id="insertSelectSubject">
		<h2>Select Material's Subject <span class="formDesc">Required. The subject your study material is for (and then the course).</span></h2>
			<select id="subject_id" multiple="multiple" size="10" name="subject_id" >
			<?php foreach($subjects as $subject): ?>
		
				<option value="<?php echo $subject->id; ?>"  <?php echo set_select('subject_id',  $subject->id); ?>><?php echo $subject->title; ?></option>
		
			<?php endforeach; ?>
		</select>
		
			<input type="hidden" id="user_id" name="user_id" value="1" />
		
		<select id="course_id" size="10" name="course_id" style="display:none;">	
		</select>
	</div>
	
	<div id="insertMaterialType">
		<h2>What kind of study material are you sharing?<span class="formDesc">Required. This helps us keep everything nice and tidy.</span></h2>
				<select id="material" size="7" name="material">
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
	Title<input type="textfield" id="insertTitle" name="title" maxlength="60" value="<?php echo set_value('title',"eg. Midterm Fall 2008 Prof Albert"); ?>" /> 
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
onKeyUp="limitText(this.form.description,this.form.countdown,350);"></textarea>
(Maximum characters: 350)
</div>

	</div>
	
	<div id="insertKeywords">
		<h2>Choose related keywords<span class="formDesc">Optional. These help make your study material more relevant and search-friendly.</span></h2>
		<input type="button" class="tag" value=" [ Answers ] ">
		<input type="button" class="tag" value=" [ Essay ] ">
		<input type="button" class="tag" value=" [ Exam ] ">
		<input type="button" class="tag" value=" [ Formula Sheet ] ">
		<input type="button" class="tag" value=" [ Lecture ] ">
		<input type="button" class="tag" value=" [ Midterm ] ">
		<input type="button" class="tag" value=" [ Presentation ] ">
		<input type="button" class="tag" value=" [ Problem Set ] ">
		<input type="button" class="tag" value=" [ Questions ] ">
		<input type="button" class="tag" value=" [ Quiz ] ">
		<input type="button" class="tag" value=" [ Reading ] ">
		<input type="button" class="tag" value="  [ Report ] ">
		<input type="button" class="tag" value="  [ Review ] ">
		<input type="button" class="tag" value="  [ Solutions ] ">
		<input type="button" class="tag" value="  [ Summary ] ">
		<input type="button" class="tag" value="  [ Syllabus ] ">
		<input type="button" class="tag" value="  [ Test ] ">
		<input type="button" class="tag" value="  [ Thesis ] ">
		<input type="button" class="tag" value="  [ Tutorial ] ">
	</div>
	
<input type="submit" value="Post Study Material" id="insertUploadButton" /> 
<?php echo form_close(); ?>
	
	</div>
	<div class="twoCol2">
	<div class="roundedCornerContent">    	
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


<script type="text/javascript" >

$(document).ready(function(){
  $("#subject_id").change( 
		
		function (){
			$("#course_id").css("display","inline");
			var url = '<?php echo site_url('uploads/getcourse/') ?>/';
			var subject_id = $("#subject_id").val();
		
			$.post(url , { 'id' : subject_id }, function(data) {
			
			var courses = '';
			for (var key in data) {
		  	courses += '<option value="' + data[key].id + '" <?php echo set_select("course_id", "'+ data[key].id +'"); ?>>' + data[key].course_title.substring(0,40) + '</option>';
		  }								
					
			$('#course_id').html(courses);
			},'json');
		}
	);  
	
	$(".tag").click(function () {
      var text = $(this).val();
      var desc = $("#insertDescription").val();
      //$("#insertDescription").text(desc+text);
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
