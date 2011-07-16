

<div id="header">
    	<div id="logo">
   	    <a href="<?php echo site_url();?>" title="Welcome to Studygig"><img src="images/studygig-logo.png" width="228" height="60" alt="Studygig Logo" /></a>
        <br />
        Find study material.  Ace your courses.
        </div>
    	<div id="mainSearchDescription">
        	Enter a textbook title, course code or subject.  Example: MATH2030 Notes
        </div>
        <div id="mainSearch">
        	<?php $attributes = array('class' => 'search', 'method' => 'post', 'name' => 'searchform', 'onsubmit' => 'return validateForm()' ); 
	echo form_open('uploads/searchfor',$attributes); ?>
<input type="text" name="query" id="mainSearchField" /><input name="submit" type="submit" value="" id="mainSearchButton" class="button" />
      <?php echo form_close(); ?>
        </div>
        <br/>
      <img src="images/books-tests-notes-labs-guides.png" width="411" height="61" alt="Search for books, tests, notes, labs, and study guides" />
  </div>
    <!-- end header div -->
    
<div id="content">
	
    	<div id="mainAction">
        <a href="index.php/uploads/insert" title="Earn rewards by sharing your study material"><img src="images/share-study-material-earn-rewards-canada.gif" width="465" height="66" alt="Share and Upload your past tests, notes, labs, and study material"/></a>
        <a href="index.php/classifieds/insert" title="Earn some cash by listing your study material"><img src="images/sell-your-books-study-material-canada.gif" width="465" height="66" alt="Sell your books, tests, notes, labs, study material" id="rightActionButton" /></a>
        </div>
        <div id="mainContentText">
            <div class="col1">
                <h1>What is Studygig?</h1>
<p>  Studygig is the easiest way university 
  students find course textbooks, past tests, 
  notes, lab reports, and anything 
  that helps them study.  Studygig allows 
  students to download, share, list and earn rewards for their study material.<br/><br/>
<b>It's free to use</b>, so get started today. <a href="index.php/site/aboutus" title="Find out more about what Studygig is">Learn more »</a></p>
            </div>
            <div class="col2">
                <h1>Now at York University...</h1>
                <img src="images/york-university.png" width="113" height="119" alt="Available in York University" class="contentImageLeft" />
              <p>If you'd like to see Studygig at your university or college, <a href="index.php/site/contact" title="Contact us about your University or College">tell us!</a>  </p>
            </div>
            <div class="col3">
                <h1>Recent Posts</h1>
                <div class="slideshow">
                	<?php $i=0; ?>
                <?php foreach($latestUploads as $upload):?>
        
       <div class="slide roundedCornerContent">
    <h2><a href="<?php echo site_url('uploads/view/'. $upload->id);?>"><?php echo htmlspecialchars($upload->title); ?></a></h2>
			 <p>
             Uploaded in <a href="<?php echo site_url('uploads/search/').'/'.substr ($latestUploadsCourses[$i],0,8);?>"><span class="courseCourseStyle"><?php echo $latestUploadsCourses[$i];?></span></a></h5>
		</p>
			 <h5> <img src="images/material<?php echo $upload->material; ?>.png" width="75" height="25" alt="Material Type" class="material-type-icon" /> <img src="images/file<?php echo $upload->filetype; ?>.png" width="20" height="20" class="file-type-icon" />
			 	
			 	
	</div>
        <?php $i++;?>
    <?php endforeach; ?>
    
	</div>
                
            </div>
         </div>
    
  </div>
    <!-- end content div -->
    
 
<script type="text/javascript" language="JavaScript">

document.forms['searchform'].elements['query'].focus();

function validateForm()
{
	var x= jQuery.trim(document.forms['searchform'].elements['query'].value);
	if (x==null || x=="" || (x.length < 5) || x=="Course name (e.g. ACTG4160 notes)" || x=="No course or subject found.")
	 {
	  	document.forms['searchform'].elements['query'].focus();
	  	return false;
	 }
}

</script>