<div id="content2">
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
	
	<div id="insertSelectSubject">
		<h2>Select a Subject <span class="formDesc">Required. The subject your study material is for (and then the course).</span></h2>
			<select id="subject_id" multiple="multiple" size="10" name="subject_id" >
			<?php foreach($subjects as $subject): ?>
		
				<option value="<?php echo $subject->id; ?>"  <?php echo set_select('subject_id',  $subject->id); ?>><?php echo $subject->title; ?></option>
		
			<?php endforeach; ?>
		</select>
				
		<select id="course_id" size="10" name="course_id" style="display:none;">	
		</select>
		
	</div>

	
	<div id="insertMaterialType">
		<h2>What kind of study material are you selling?<span class="formDesc">Required. This helps us keep everything nice and tidy.</span></h2>
				<select id="material" size="5" name="material">
		<option value="7" <?php echo set_select('material', '7'); ?>>Book</option>
		<option value="1" <?php echo set_select('material', '1'); ?>>Test Package (quizes, tests, midterms, exams, etc.)</option>
		<option value="2" <?php echo set_select('material', '2'); ?>>Note Package (notes, study guides, reference material, labs, etc.)</option>
		<option value="8" <?php echo set_select('material', '8'); ?>>All-in-one Package (book, test package, note package)</option>
		<option value="6" <?php echo set_select('material', '6'); ?>>Other</option>
	</select>		
	
	</div>
	
	<div id="insertUTitleDesc">
		<h2>Describe your study material<span class="formDesc">Required. The more details your write, the easier it will be to find and the more points you'll earn!</span></h2>	
				
			<div class="insertCol1">
	Title<input type="textfield" id="insertTitle" name="title" maxlength="60" value="<?php echo set_value('title',"eg. Microeconomics (7th Edition)"); ?>" />
	<br/>
	Price ($)<input type="textfield" id="insertPrice" name="price" maxlength="30" value="<?php echo set_value('price',"eg. 100"); ?>" />
	</div>
	<div class="insertCol2">
	Description
	<textarea id="insertDescription" name="description" rows="5" cols="30" onKeyDown="limitText(this.form.description,this.form.countdown,350);" 
onKeyUp="limitText(this.form.description,this.form.countdown,350);"></textarea>
(Maximum characters: 350)
</div>

	</div>
	
	<div id="insertKeywords">
		<h2>Choose related keywords<span class="formDesc">Optional. These help make your study material more relevant and search-friendly.</span></h2>
		<input type="button" class="tag" value=" Answers ">
		<input type="button" class="tag" value=" Essay ">
		<input type="button" class="tag" value=" Exam ">
		<input type="button" class="tag" value=" Formula Sheet ">
		<input type="button" class="tag" value=" Lecture ">
		<input type="button" class="tag" value=" Midterm ">
		<input type="button" class="tag" value=" Presentation ">
		<input type="button" class="tag" value=" Problem Set ">
		<input type="button" class="tag" value=" Questions ">
		<input type="button" class="tag" value=" Quiz ">
		<input type="button" class="tag" value=" Reading ">
		<input type="button" class="tag" value=" Report ">
		<input type="button" class="tag" value=" Review ">
		<input type="button" class="tag" value=" Solutions ">
		<input type="button" class="tag" value=" Summary ">
		<input type="button" class="tag" value=" Syllabus ">
		<input type="button" class="tag" value=" Test ">
		<input type="button" class="tag" value=" Thesis ">
		<input type="button" class="tag" value=" Tutorial ">
	</div>
	
	<div id="postfb">
		<h2>Would you like to tell your friends on Facebook?<span class="formDesc">Optional.</span></h2>
		<label><input type="checkbox" name="postfb" id="postfb" value="1" /> I would like to make a Facebook post.</label>
	</div>
	
	<p>By uploading a file you certify that you have the right to distribute it and that it does not violate the Terms of Use.</p>
	
<input type="submit" value="Post Study Material" id="insertUploadButton" /> 
<?php echo form_close(); ?>
	
	</div>
	<div class="twoCol2">
	<div class="roundedCornerContent">
        <h1>Sell Your Stuff & Save</h1>
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

    
    $("#insertTitle").click(function() {
    if ($("#insertTitle").val() == "eg. Microeconomics (7th Edition)" ){
    	$("#insertTitle").attr('value', '');
    	$("#insertTitle").css('color','#000000');
    }
	});
	
	$("#insertPrice").click(function() {
    if ($("#insertPrice").val() == "eg. 100" ){
    	$("#insertPrice").attr('value', '');
    	$("#insertPrice").css('color','#000000');
    }
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
