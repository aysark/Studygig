<div id="content2">
<a name="top"></a>
<div class="twoCol1">
<?php if($results):?>
      
      <?php if($is_upload): ?>

		<?php if ($crows == 0):?>
	      <div id="viewClassifieds"><img src="<?php echo base_url().'images/uploads-icon'; ?>.png" class="textmiddle" /> Shared (<?php echo $urows; ?>)</div>
	    <div id="viewClassifiedsOff"><img src="<?php echo base_url().'images/classifieds-icon2'; ?>.png" class="textmiddle" /> Classifieds (0)</div>
		  <?php else: ?>
	  	 <div id="viewClassifieds"><img src="<?php echo base_url().'images/uploads-icon'; ?>.png" class="textmiddle" /> Shared (<?php echo $urows; ?>)</div>
	    <a href="<?php echo site_url('classifieds/search/'.$query); ?>"><div id="viewClassifiedsOff"><img src="<?php echo base_url().'images/classifieds-icon2'; ?>.png" class="textmiddle" /> Classifieds (<?php echo $crows; ?>)</div></a>
	
		<?php endif; ?>
	
	<div id="shareResults">Share Results:<input type="textfield" name="shareResultsLink" size="20"  id="uploadLinkField" value="<?php echo site_url('uploads/search/').'/'.$query;?>"  onClick="SelectAll('uploadLinkField');" style="display: inline; "/></div>

    <?php $i=0; ?>
    <?php foreach($results as $upload): ?>

    <div class="result">
    	<div class="twoCol11">
    	<h1><img src="<?php echo base_url().'images/material'.$materials[$i]; ?>.png" width="75" height="25" alt="Material Type" class="material-type-icon" /> 
<img src="<?php echo base_url().'images/file'.$upload->filetype; ?>.png" width="20" height="20" class="file-type-icon" />

<a href="<?php echo site_url('uploads/view/'. $upload->upload_id);?>"><?php echo htmlspecialchars($upload->upload_title); ?></a></h1>
         <h5>Uploaded by <?php echo $users[$i]. " on " . date('F j, Y \a\t g:i A', strtotime($upload->created_at));?> in <a href="<?php echo site_url('uploads/search/').'/'.substr ($courses[$i],0,8);?>"><span class="courseCourseStyle"><?php echo $courses[$i]; ?></span></a></h5> 
          <p>
    <?php 
    $str = str_replace('\n','<br>',htmlspecialchars($upload->description));
    $str = str_replace('\r','<br>',$str);
               
    echo substr($str,0,100).'...';
    
    ?></p>
    	</div>
    	
    	<div class="twoCol22">
    	<div id="ratingFeedback<?php echo $upload->upload_id; ?>" class="ui-corner-all" style="padding-top: 0px; padding-right: 0.3em; padding-bottom: 0px; padding-left: 0.3em;" ></div>
<form action="" method="post" accept-charset="utf-8" id="ratingForm<?php echo $upload->upload_id; ?>" >
        <input type="submit" class="ratingIconGood" id="ratingIconGood<?php echo $upload->upload_id; ?>" name="rating_typeA" value="<?php echo $ratings[$i]['positive']; ?>" onclick="loadGoodVote2(<?php echo $upload->upload_id;?>,<?php echo $ratings[$i]['positive'] + 1;?>)"/>
        <input type="submit" class="ratingIconBad" id="ratingIconBad<?php echo $upload->upload_id; ?>"  name="rating_typeA" value="<?php echo $ratings[$i]['negative']; ?>" onclick="loadBadVote2(<?php echo $upload->upload_id;?>,<?php echo $ratings[$i]['negative'] + 1;?>)"/>
    	</form>

    <a href="<?php echo site_url('uploads/view/'. $upload->upload_id.'#disqus_thread');?>" data-disqus-identifier="<?php echo "u".$upload->upload_id; ?>" id="commIcon"></a>
            </div>
    	
    	<?php $i++;?>
    </div>
    
    <?php endforeach;?>

<div class="clear"></div>
<?php echo $pagination;?>

	<?php else: ?>
		
	<?php if ($urows == 0): ?>

	  <div id="viewClassifiedsOff"><img src="<?php echo base_url().'images/uploads-icon'; ?>.png" class="textmiddle" /> Shared (0)</div>
		
		<div id="viewClassifieds"><img src="<?php echo base_url().'images/classifieds-icon2'; ?>.png" class="textmiddle" /> Classifieds (<?php echo $crows; ?>)</div>
		
	<?php else: ?>
		
		<a href="<?php echo site_url('uploads/search/'.$query); ?>"><div id="viewClassifiedsOff"><img src="<?php echo base_url().'images/uploads-icon'; ?>.png" class="textmiddle" /> Shared (<?php echo $urows; ?>)</div></a>
		
		<div id="viewClassifieds"><img src="<?php echo base_url().'images/classifieds-icon2'; ?>.png" class="textmiddle" /> Classifieds (<?php echo $crows; ?>)</div>
		
	<?php endif; ?>
	
	<div id="shareResults">Share Results:<input type="textfield" name="shareResultsLink" size="20"  id="uploadLinkField" value="<?php echo site_url('classifieds/search/').'/'.$query;?>"  onClick="SelectAll('uploadLinkField');" style="display: inline; "/></div>
	
	<?php $i=0 ?>
	<?php foreach($results as $classified): ?>
		
		<div class="result">
    	<div class="twoCol11">
    	<h1><img src="<?php echo base_url().'images/material'.$materials[$i]; ?>.png" width="75" height="25" alt="Material Type" class="material-type-icon" /> 

<a href="<?php echo site_url('classifieds/view/'. $classified->classified_id);?>"><?php echo htmlspecialchars($classified->classified_title); ?></a></h1>
         <h5>Posted by <?php echo $users[$i]. " on " . date('F j, Y \a\t g:i A', strtotime($classified->created_at));?> in <a href="<?php echo site_url('uploads/search/').'/'.substr ($courses[$i],0,8);?>"><span class="courseCourseStyle"><?php echo $courses[$i]; ?></span></a></h5> 
          <p><?php      
    $str = str_replace('\n','<br>',htmlspecialchars($classified->description));
    $str = str_replace('\r','<br>',$str);
               
    echo substr($str,0,100).'...';
          	
          	?></p>
    	</div>
    	
    	<div class="twoCol22">
    		<div class="resultsPrice">$<?php echo $classified->price; ?></div>
        </div>
    	
    	<?php $i++;?>
    </div>
    
    <?php endforeach;?>

<div class="clear"></div>
<?php echo $pagination;?>
	 <?php endif; ?>

<?php else: ?>
    
        <h2>Your search did not match any posts.  Suggestions:</h2>
<p><ul class="guidelines">
<li>If searching a course code, do not include a space between the letters and numbers (eg. do this: CSE1020, not this: CSE 1020)</li>
<li>Make sure all words are spelled correctly.</li>
<li>Try different keywords.</li>
<li>Try more general keywords.</li>
<li>Try fewer keywords.</li>
</ul></p>
<h2>Alternatively you can...</h2>
    	<a href="../../uploads/insert" id="postStudyMaterialButton2">Post study material & earn cash rewards</a>  
    	
<form action="" method="post" accept-charset="utf-8" id="requestForm" >
 <input type="submit" class="jqbutton"  name="requestSM" value="Request study material" onclick="rqtStudyMaterial()"/>
</form>	

    	<div id="resultsFd" class="rewardFeedback ui-corner-all" ></div>

<div id="anotherUni">
		<h2>Study at a different university?</h2>
		<p>Join our mailing list and be the first to find out when new universities are added.  Enter your email below.</p>
		<form action="" method="post" accept-charset="utf-8"  id="signupEmailUni" >
<input type="textfield" class="formTextField2Inline" id="signupEmailUniField" name="email" maxlength="30" />
 <input type="submit" class="jqbutton" name="emailUniSignup" value="Sign Up" onclick="signupEmailUni()"/>
</form>	
<div id="resultsFd2" class="rewardFeedback ui-corner-all" ></div>
</div>

   <?php endif; ?>
   

</div>
<div class="twoCol2">
<div id="accordion">
	<h4><a href="#">Search Filters</a></h4>
		<?php if($is_upload): ?>
		
		<form action="<?php echo site_url('uploads/search/'.$query);?>" method="post" accept-charset="utf-8">
	<div id="sortMenu">
	<b>Sort by</b>
		<select name="sortResultsBy">
		<option value="0">Recommended</option>
		<option value="1">Most viewed</option>
		<option value="2">Rating: high to low</option>
		<option value="3">Rating: low to high</option>
		<option value="4">Newest</option>
	</select>
	</div>
<b>Filter by material type</b>
			<label class="searchFilterMaterialType"><input type="checkbox" name="materialTypeFilter[]" value="1" /> Quiz/Test/Exam</label>
			<label class="searchFilterMaterialType"><input type="checkbox" name="materialTypeFilter[]"  value="2" /> Assignment/Solutions</label>
			<label class="searchFilterMaterialType"><input type="checkbox" name="materialTypeFilter[]"  value="3" /> Study Guide</label>
			<label class="searchFilterMaterialType"><input type="checkbox" name="materialTypeFilter[]"  value="4" /> Reference/Eqn Sheet</label>
			<label class="searchFilterMaterialType"><input type="checkbox" name="materialTypeFilter[]"  value="5" /> Lab Material/Report</label>
			<label class="searchFilterMaterialType"><input type="checkbox" name="materialTypeFilter[]" value="6" /> Lecture Notes</label>
			<label class="searchFilterMaterialType"><input type="checkbox" name="materialTypeFilter[]"  value="7" /> Other</label>
			
			<input type="submit" class="jqbutton" style="float:right;" value=" Apply " /> 
		<p><br></p>
		
		</form>
		
		<?php else: ?>
			
			<form action="<?php echo site_url('classifieds/search/'.$query);?>" method="post" accept-charset="utf-8">
	<div id="sortMenu">
	<b>Sort by</b>
		<select name="sortResultsBy">
		<option value="0">Newest</option>
		<option value="1">Most viewed</option>
		<option value="2">Price: high to low</option>
		<option value="3">Price: low to high</option>
	</select>
	</div>
<b>Filter by material type</b>
<label class="searchFilterMaterialType"><input type="checkbox" name="materialTypeFilter[]" value="8" /> Book</label>
			<label class="searchFilterMaterialType"><input type="checkbox" name="materialTypeFilter[]" value="9" /> Test Package</label>
			<label class="searchFilterMaterialType"><input type="checkbox" name="materialTypeFilter[]"  value="10" /> Note Package</label>
			<label class="searchFilterMaterialType"><input type="checkbox" name="materialTypeFilter[]"  value="11" /> All-in-one Package</label>
			<label class="searchFilterMaterialType"><input type="checkbox" name="materialTypeFilter[]"  value="12" /> Other</label>
			
			<input type="submit" value="Apply" /> 
			
		</form>
		<?php endif; ?>
	<br/>

	
</div>
<a href="../insert"><div id="memberAd2">
</div></a>
</div>
</div>
    <!-- end content div -->

<script type="text/javascript">
	
 function rqtStudyMaterial(){
  	/* attach a submit handler to the form */
  $("#requestForm").submit(function(event) {
    /* stop form from submitting normally */
    event.preventDefault(); 
  });
  	var request = "<?php echo $query; ?>";
  	//  Send the data using post and put the results in a div 
    $.post( "../../uploads/requestStudyMaterial", {query:request},
      function( data ) {
      	$("#resultsFd").css({'visibility' : 'visible', 'background-color' : '#fbec88', 'color':'#363636','margin-bottom':'5px','border':'1px solid #fad42e'}	);
      	document.getElementById("resultsFd").innerHTML=data;
      });
  }
  
  function signupEmailUni(){
  	/* attach a submit handler to the form */
  $("#signupEmailUni").submit(function(event) {
    /* stop form from submitting normally */
    event.preventDefault(); 
  });
  	var email = $("#signupEmailUniField").val();

  	//  Send the data using post and put the results in a div 
    $.post( "../../uploads/emailSignup", {email:email},
      function( data ) {
      	$("#resultsFd2").css({'visibility' : 'visible', 'background-color' : '#fbec88', 'color':'#363636','margin-bottom':'5px','border':'1px solid #fad42e'}	);
      	document.getElementById("resultsFd2").innerHTML=data;
      });
  }
  
    $(document).ready(function(){
    	$("#sortResultsForm").change(onSelectChange);
       $( "#accordion" ).accordion({ collapsible: false});
       $( ".jqbutton" ).button();
    })
    

function onSelectChange(){
	$('#sortResultsForm').submit();
}

    function loadGoodVote2(uploadid, value){
  	/* attach a submit handler to the form */
  $("#ratingForm"+uploadid).submit(function(event) {

    /* stop form from submitting normally */
    event.preventDefault(); 
  });
  	
  	 /* Send the data using post and put the results in a div */
    $.post( "<?php echo site_url('ratings/add');?>", { rating_type: "1", upload_id: uploadid},
      function( data ) {
      	$("#ratingFeedback"+uploadid).css({'visibility' : 'visible', 'background-color' : '#fbec88', 'color':'#363636','margin-bottom':'5px','border':'1px solid #fad42e'}	);
      	document.getElementById("ratingFeedback"+uploadid).innerHTML=data;
         $("#ratingIconGood"+uploadid).css("background-position","left bottom");
         $("#ratingIconGood"+uploadid).css("color","#009b00");
         $('#ratingIconGood'+uploadid).attr('value', value);
      }
    );
  }
  
    function loadBadVote2(uploadid,value){
  	/* attach a submit handler to the form */
  $("#ratingForm"+uploadid).submit(function(event) {
    /* stop form from submitting normally */
    event.preventDefault(); 
  });
  	
  	 /* Send the data using post and put the results in a div */
    $.post( "<?php echo site_url('ratings/add');?>", { rating_type: "0", upload_id: uploadid},
      function( data ) {
      	
      	$("#ratingFeedback"+uploadid).css({'visibility' : 'visible', 'background-color' : '#fbec88', 'color':'#363636','margin-bottom':'5px','border':'1px solid #fad42e'}	);
      	document.getElementById("ratingFeedback"+uploadid).innerHTML=data;
         $("#ratingIconBad"+uploadid).css("background-position","left bottom");
         $("#ratingIconBad"+uploadid).css("color","#9b0000");
         $('#ratingIconBad'+uploadid).attr('value', value);
      });
  }
  
  function SelectAll(id)
{
    document.getElementById(id).focus();
    document.getElementById(id).select();
}
 
    /* * * CONFIGURATION VARIABLES: EDIT BEFORE PASTING INTO YOUR WEBPAGE * * */
    var disqus_shortname = 'studygig'; // required: replace example with your forum shortname
 
    /* * * DON'T EDIT BELOW THIS LINE * * */
    (function () {
        var s = document.createElement('script'); s.async = true;
        s.type = 'text/javascript';
        s.src = 'http://' + disqus_shortname + '.disqus.com/count.js';
        (document.getElementsByTagName('HEAD')[0] || document.getElementsByTagName('BODY')[0]).appendChild(s);
    }());
</script>
