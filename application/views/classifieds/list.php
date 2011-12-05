<h1>Latest Classifieds</h1>

<div id="content2" style="margin-top:10px">
<a name="top"></a>
<div class="twoCol1">
	
	<a href="<?php echo site_url('uploads/getsearchfor/'.$query); ?>"><div id="viewClassifiedsOff"><img src="<?php echo base_url().'images/uploads-icon'; ?>.png" class="textmiddle" /> Shared (<?php echo $urows; ?>)</div></a>
		
		<div id="viewClassifieds"><img src="<?php echo base_url().'images/classifieds-icon2'; ?>.png" class="textmiddle" /> Classifieds (<?php echo $crows; ?>)</div>
		
		<div id="shareResults">Share Results:<input type="textfield" name="shareResultsLink" size="20"  id="uploadLinkField" value="<?php echo site_url('classifieds/search/').'/'.$query;?>"  onClick="SelectAll('uploadLinkField');" style="display: inline; "/></div>
	
	<?php $i=0 ?>
	<?php foreach($results as $classified): ?>
		
		<div class="result">
    	<div class="twoCol11">
    	<h1><img src="<?php echo base_url().'images/material'.$materials[$i]; ?>.png" width="75" height="25" alt="Material Type" class="material-type-icon" /> 

<a href="<?php echo site_url('classifieds/view/'. $classified->classified_id);?>"><?php echo htmlspecialchars($classified->classified_title); ?></a></h1>
         <h5>Posted by <?php echo $users[$i]. " on " . date('F j, Y \a\t g:i A', strtotime($classified->created_at));?> in <a href="<?php echo site_url('uploads/getsearchfor/').'/'.substr ($courses[$i],0,8);?>"><span class="courseCourseStyle"><?php echo $courses[$i]; ?></span></a></h5> 
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
</div>
<div class="twoCol2">
	<div id="accordion">
	<h4><a href="#">Search Filters</a></h4>
	<div>
		
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
			
			<input type="submit" class="jqbutton" style="float:right;" value=" Apply " /> 
		<br><br>
			
		</form>
	</div>
	<h4><a href="#">Subscribe to Classifieds</a></h4>
	<div>
		Get the notified whenever a new classified ad has been posted right at your inbox!
		<form action="http://feedburner.google.com/fb/a/mailverify" method="post" target="popupwindow" onsubmit="window.open('http://feedburner.google.com/fb/a/mailverify?uri=studygig', 'popupwindow', 'scrollbars=yes,width=550,height=520');return true"><p>	Enter your email address:</p><input type="text" style="width:180px" name="email"/><input type="hidden" value="studygig" name="uri"/><input type="hidden" name="loc" value="en_US"/><input type="submit"  class="jqbutton" style="float:right;"  value=" Subscribe " /></form>
			<a target="_blank" href="http://feeds.feedburner.com/~r/studygig/~6/3"><img src="http://feeds.feedburner.com/studygig.3.gif" alt="Studygig Classifieds" style="border:0"></a>
	</div>
</div>
<a href="../insert"><div id="memberAd2">
</div></a>
</div>
</div>