<div id="header">
    	<div id="slogan">
       	 	Find helpful study material.
        </div>
    	<div id="subslogan">
        	Search more than 1000 documents from 500+ students (and counting)
        </div>
        <div id="mainSearch">
        	<?php $attributes = array('class' => 'search', 'method' => 'post', 'name' => 'searchform', 'onsubmit' => 'return validateForm()' ); 
	echo form_open('uploads/searchfor',$attributes); ?>
<input type="text" name="query" id="mainSearchField" /><input name="submit" type="submit" value="" id="mainSearchButton" class="button" />
      <?php echo form_close(); ?>
        </div>
      
  </div>
    <!-- end header div -->
    <div id="greyButtonNav">
    	<a href="index.php/uploads/insert" ><div id="greyButton1"></div></a>
    	<a href="index.php/classifieds/insert"  ><div id="greyButton2"></div></a>
	</div> <!-- end grey button nav div -->
    <div class="clear"></div>
    
    
<div id="content">
        <div id="mainContentText">
            <div class="col1">
                <h1>Collaborate</h1>
                <div id="collaborateIcon"></div>
<p class="featureText">  <b>Find and share class notes</b>, past tests and study guides at the click of a button.  Connect with other students and collaborate in real-time.  <a href="">Learn more »</a> </p>
            </div>
            <div class="col2">
                <h1>Study Smarter</h1>
                <div id="studyIcon"></div>
<p class="featureText">  <b>Improve your GPA</b>, access notes at anytime, anywhere to help you study more effectively.  Your notes in the cloud.  <a href="">Learn more »</a> </p>
            </div>
            <div class="col3">
                <h1>Get Rewarded</h1>
                <div id="rewardIcon"></div>
<p class="featureText">  <b>Earn points for sharing your notes</b>. Exchange them for real-life rewards.  <a href="">Learn more »</a> </p>
            </div>
         </div>
         <div class="clear"></div>
    <div id="subContent">
    	<a href="/"><div id="now-at-york-university"></div></a>
    	<a href="index.php/site/academicintegrity"><div id="supported-by-your-professor"></div></a>
    	<a href="index.php/site/tenreasons"><div id="reasons-students-use-studygig"></div></a>
    	<a href="/"><div id="studygig-classifieds-sell-buy-text-books"></div></a>
    	
    	<div class="clear"></div>
    	<br/>
    	<div id="seperatorHalf">
  	</div>
    	<h1 style="float:left;">
  	Recent Uploads</h1>
  	<div id="seperatorHalf">
  	</div>
  	<div class="clear"></div>
    	<div class="col1">
    	<div class="slideshow">
                	<?php $i=0; ?>
                <?php foreach($latestUploads1 as $upload):?>
        
       <div class="slide roundedCornerContent">
    <h2><img src="images/materialIcons/material<?php echo $upload->material; ?>.jpg" alt="Material Type" class="recentPostIcon" /> 
    	<a href="<?php echo site_url('uploads/view/'. $upload->id);?>"><?php echo htmlspecialchars($upload->title); ?></a></h2>
            <h5> <?php echo $latestUploadsUsers[$i];  ?> just uploaded in <a href="<?php echo site_url('uploads/search/').'/'.substr ($latestUploadsCourses[$i],0,8);?>"><span class="courseCourseStyle"><?php echo $latestUploadsCourses[$i].'</a> '?></span>
	
			</h5>
			 	
	</div>
        <?php $i++;?>
    <?php endforeach; ?>
</div><!-- eng slide-->
</div><!-- end col -->
<div class="col2">
    	<div class="slideshow">
                	<?php $i=0; ?>
                <?php foreach($latestUploads2 as $upload):?>
        
       <div class="slide roundedCornerContent">
    <h2><img src="images/materialIcons/material<?php echo $upload->material; ?>.jpg" alt="Material Type" class="recentPostIcon" /> 
    	<a href="<?php echo site_url('uploads/view/'. $upload->id);?>"><?php echo htmlspecialchars($upload->title); ?></a></h2>
			   <h5> <?php echo $latestUploadsUsers[$i];  ?> just uploaded in <a href="<?php echo site_url('uploads/search/').'/'.substr ($latestUploadsCourses[$i],0,8);?>"><span class="courseCourseStyle"><?php echo $latestUploadsCourses[$i].'</a> '?></span>
	
			</h5>
			 	
	</div>
        <?php $i++;?>
    <?php endforeach; ?>
</div><!-- eng slide-->
</div><!-- end col -->
	<div class="col3">
    	<div class="slideshow">
                	<?php $i=0; ?>
                <?php foreach($latestUploads3 as $upload):?>
        
       <div class="slide roundedCornerContent">
    <h2><img src="images/materialIcons/material<?php echo $upload->material; ?>.jpg" alt="Material Type" class="recentPostIcon" /> <a href="<?php echo site_url('uploads/view/'. $upload->id);?>"><?php echo htmlspecialchars($upload->title); ?></a></h2>
			 <p>
              <h5> <?php echo $latestUploadsUsers[$i];  ?> just uploaded in <a href="<?php echo site_url('uploads/search/').'/'.substr ($latestUploadsCourses[$i],0,8);?>"><span class="courseCourseStyle"><?php echo $latestUploadsCourses[$i].'</a> '?></span>
	
			</h5>
			 	
	</div>
        <?php $i++;?>
    <?php endforeach; ?>
</div><!-- eng slide-->
</div><!-- end col -->
</div><!-- end subcontent-->
    
  </div>
    <!-- end content div -->
    
    
 
<script type="text/javascript" language="JavaScript">

document.forms['searchform'].elements['query'].focus();

 $("#booksIconSearch").click(function () { 
 	   document.forms['searchform'].elements['query'].value = "Advanced Macroeconomics - David Romer";
 	   document.forms['searchform'].elements['query'].select();
    });
$("#testsIconSearch").click(function () { 
      document.forms['searchform'].elements['query'].value = "Math2030 Tests";
      document.forms['searchform'].elements['query'].select();
    });
$("#notesIconSearch").click(function () { 
      document.forms['searchform'].elements['query'].value = "NATS1840 Notes";
      document.forms['searchform'].elements['query'].select();
    });
$("#labsIconSearch").click(function () { 
      document.forms['searchform'].elements['query'].value = "Project Exobots Proposal";
      document.forms['searchform'].elements['query'].select();
    });
$("#guidesIconSearch").click(function () { 
      document.forms['searchform'].elements['query'].value = "ADMS1000 Review";
      document.forms['searchform'].elements['query'].select();
    });


function validateForm()
{
	var x= jQuery.trim(document.forms['searchform'].elements['query'].value);
	
	if (x==null || x=="" || x.length < 5)
	 {
	  	document.forms['searchform'].elements['query'].focus();
	  	return false;
	 }else{
	 	//mpmetrics.track("Search", {"Query": x}); 
	 	return true;
	 }
}

</script>