<script type="text/javascript" src="/uploadify/jquery-1.4.2.min.js"></script>
<script type="text/javascript" src="/uploadify/swfobject.js"></script>
<script type="text/javascript" src="/uploadify/jquery.uploadify.v2.1.4.min.js"></script>

<script type="text/javascript">
$(document).ready(function() {
var filenames;
var extension;
var textfield;
  $('#file_upload').uploadify({
    'uploader'  : '/uploadify/uploadify.swf',
    'script'    : '/uploadify/uploadify.php',
    'cancelImg' : '/uploadify/cancel.png',
    'folder'    : 'uploads',
    'auto'      : false,
    'displayData' : 'speed',
    'expressInstall' : '/uploadify/expressInstall.swf',
    'fileDataName' : 'Filedata',
    'fileExt'     : '*.docx;*.doc;*.ppt;*.pptx;*.gif;*.jpg;*.jpeg;*.png',
  	'fileDesc'    : 'DOC,PPT,IMAGES',
  	'multi'       : true,
  	'queueSizeLimit' : 10,
  	'removeCompleted' : true,
  	'scriptAccess' : 'sameDomain',
  	'scriptData'  : {'user_id':1},
  	'sizeLimit'   : 52428800,
  	'onComplete'  : function(event, ID, fileObj, response, data) {
  		
  		var fileinfo = eval('(' + response + ')');
  		//get name
  		filenames = $('#filename-text').val();
    	$('#filename-text').val(filenames+fileinfo["name"] + ' ');
    	alert($('#filename-text').val());
    	//get extension
    	extension = $('#fileext-text').val();
    	$('#fileext-text').val(extension+fileinfo["ext"] + ',');
    	
    	//get sizes
    	textfield = $('#filesize-text').val();
    	$('#filesize-text').val(textfield+fileinfo["size"] + ',');
    	
},
  	'onAllComplete' : function(event,data) {
  		
     $('html,body').animate({scrollTop: $("#file_upload").top},'fast');
     	var fileNames = $('#filename-text').val();
     	var fileExt = $('#fileext-text').val();
     	var fileSize = $('#filesize-text').val();
     	
     	var url = '<?php echo site_url('admin/moderators/upload') ?>';
		
		$.post(url , { 'fileNames' : fileNames, 
						'fileExt' : fileExt,
						'fileSize' : fileSize,
						'numOfFiles' : data.filesUploaded,
						'course_id' : $('#subject_id').val(),
						'subject_id' : $('#course_id').val(),
						'material' : $('#material').val(),
						'title' : $('#insertTitle').val(),
						'description' : $('#insertDescription').val(),
						'tags' : $('#multi_example').val()
						}, function(data) {
		$("#uploadFeedback").css({'visibility' : 'visible', 'background-color' : '#fbec88', 'color':'#363636','margin-bottom':'5px','border':'1px solid #fad42e'}	);
      	document.getElementById("uploadFeedback").innerHTML=data;   
		});
    }
  });
});

/**
 * This function tells SWFUpload to start uploading the queued files.
 */
function uploadFile(form, e) {
		var x=document.forms["form"]["subject_id"].value;
	if (x==null || x=="")
	 {
	  alert("Subject must be filled out");
	  return false;
	 }
	 
	 x=document.forms["form"]["course_id"].value;
	if (x==null || x=="")
	 {
	  alert("Course must be filled out");
	  return false;
	 }
	 
	 x=document.forms["form"]["material"].value;
	if (x==null || x=="")
	 {
	  alert("Material must be filled out");
	  return false;
	 }
	 
	 x=document.forms["form"]["title"].value;
	if (x==null || x=="")
	 {
	  alert("Title must be filled out");
	  return false;
	 }
	 
	 x=document.forms["form"]["description"].value;
	if (x==null || x=="" || x.length < 20)
	 {
	  alert("Description must be more than 20 chars");
	  return false;
	 }
    try {
        $('#file_upload').uploadifyUpload();
    } catch (ex) {
    }
    return false;
}
</script>

<div id="content2">
<div class="twoCol1">
	<a href="../">< Back to Admin Panel</a>
	<?php 	$attributes = array('name'=>'form','id' => 'uploadform', 'onsubmit' => 'return uploadFile(this, event);' );
		echo form_open_multipart('admin/moderators/upload',$attributes); 	?>
				
	<div id="insertUploadType">
		<h2>Study Material Uploader<span class="formDesc">Required. You can upload from your computer or share a link from the web.  You can only upload Word, PowerPoint, PDF, or image files (eg. scanned papers).</span></h2>	
		    	 <p>Select file(s) (must be in PDF, PPT, DOC, DOCX, JPEG/JPG, PNG or GIF format, <b>max file size: 50 MB</b>) - note you need flash 9+ to use it, so be sure to get <a href="http://www.adobe.com/products/flashplayer/">here</a>:</p>
<div id="uploadFeedback" class="ui-corner-all" style="padding: 10px;" ></div>	
<b>DO NOT TRY TO UPLOAD PDF FILES - THERE IS AN ERROR WITH GENERATING PREVIEWS FOR PDFS</b>, if you try to upload a pdf it will upload successfully but no image preview will be generated and then your upload will have a broken image linked to it!
<div>
		<input id="file_upload" name="file_upload" type="file" />
		<div class="clear"></div>		
		<input type="hidden" name="filename-text" id="filename-text" value="" />
		<input type="hidden" name="fileext-text" id="fileext-text" value="" />
		<input type="hidden" name="filesize-text" id="filesize-text" value="" />
</div>		

</div>
	
	<div id="insertSelectSubject">
		<h2>Select Material's Subject <span class="formDesc">Required. The subject your study material is for (and then the course).</span></h2>
			<select id="subject_id"  size="10" name="subject_id" class="chzn-select1" title="Choose a Subject..." tabindex="2" >
			<?php foreach($subjects as $subject): ?>
		
				<option value="<?php echo $subject->id; ?>"  <?php echo set_select('subject_id',  $subject->id); ?>><?php echo $subject->title; ?></option>
		
			<?php endforeach; ?>
		</select>
		
			<input type="hidden" id="user_id" name="user_id" value="1" />
		
		<div id="courses_select">
		<select id="course_id" size="10" name="course_id"  class="chzn-select2" title="Choose a Course..." tabindex="3">
			</select>
		</div>
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
	Title<input type="textfield" id="insertTitle" name="title" maxlength="60" value="<?php echo set_value('title'); ?>" /> 
	<p class="smallText"><b>Examples of good titles:</b><br/>
		F09 Midterm 1<br/>
		Lecture 8 Notes - Business Management<br/>
		Assignment 4 w/ Solutions<br/>
		Textbook Chapter Summaries (1-4)<br/>
	</p>
	</div>
	<div class="insertCol2">
	Description
	<textarea id="insertDescription" name="description" rows="5" cols="30" ></textarea>
(Maximum characters: 350)
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
	<br>

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
        
        	<span class="blueh2">Include in Descriptions</span>
        <ul class="guidelines">
        	<li>Year & term study material was used for (ie. 2008 Fall)</li>
        	<li>Professor's/Instructor's name</li>
        	<li>Material description (what it includes, how it will help, etc.)</li>
        </ul>
            <span class="blueh2">Don't Forget Tags!</span>
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
	    
    $("select[name='material']").change(function() {
        var test = $(this).val();
        $("div.materialType").hide();
       	 $("#material"+test).show();
       	 
    });
	
});	 	  

</script>
