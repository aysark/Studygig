
<div id="content2">
	<div class="twoCol1">    
    <div class="docViewTitleIcons">
    	
    	<?php if($this->session->userdata('logged_in') && !$favourited): ?>
    	<a href="<?php echo site_url('uploads/favourite/'. $upload->id); ?>"><div id="favIcon">Favourite</div></a>
    	<?php endif; ?><?php if($favourited): ?>
    	<a href="<?php echo site_url('uploads/unfavourite/'. $upload->id); ?>"><div id="favIcon2">Remove</div></a>
    	<?php endif; ?>
    	<a href="<?php echo site_url('uploads/view/'. $upload->id.'#disqus_thread');?>" data-disqus-identifier="<?php echo $upload->id; ?>" id="commIconView"></a>
    </div>
    <h1><?php echo htmlspecialchars($upload->title);?> </h1>
        
    <h5> <img src="../../images/material<?php echo $materialType; ?>.png" width="75" height="25" alt="Material Type" class="material-type-icon" /> <img src="../../images/file<?php echo $fileType; ?>.png" width="20" height="20" class="file-type-icon" />
             Uploaded by <?php echo $uploader->username. " on " . date('F j, Y \a\t g:i A', strtotime($upload->created_at));?> in <a href="<?php echo site_url('uploads/getsearchfor/').'/'.substr ($course,0,8);?>"><span class="courseCourseStyle"><?php echo $course;?></span></a></h5> 
             
             <div class="docActualView">
             	
             	<?php 

if($upload->filesize == -1){
	?>
		<a href="<?php echo $upload->filepath; ?>" target="_blank">Redirecting you to <?php 
			header('Refresh: 5; URL='.$upload->filepath);
			echo htmlspecialchars($upload->title);  ?> in 5 seconds.  If you are not redirected click here.</a>
	<?php	
}else{
	if ((strcasecmp($upload->filetype,".jpg") == 0) || (strcasecmp($upload->filetype,".jpeg") == 0) || 	(strcasecmp($upload->filetype,".gif") == 0) || (strcasecmp($upload->filetype,".png")== 0)){
			echo "<img src=\"".base_url().$file['path']."\"/>";
		}else{
	$pdfurl = base_url(). $file['path'];
	?>

	<iframe src="http://crocodoc.com/view/?sessionId=<?php echo $sessionid; ?>" style="width:650px; height:730px;" frameborder="0"></iframe>		
			<?php
	}
}
?>
             
             </div>
             
                 <div class="docDescription">
                <div class="docContent">
               <?php 
               $str = str_replace('\n','<br>',htmlspecialchars($upload->description));
               $str = str_replace('\r','<br>',$str);
               
               echo $str; 
               ?>
            
                <?php if($related): ?>
                <h4>Related Documents <a href="#" class="dashHelp" title="These are documents that were uploaded with the above upload- it might be a continuation of the above."><img src="../../../images/help-icon.gif" width="16" height="15" alt="Help Icon" /></a></h4>
                <p>    <ol><?php foreach($moreByUser as $relatedUpload):?>
    	<li><a href="<?php echo site_url('uploads/view/'. $relatedUpload->id);?>"><?php echo htmlspecialchars($relatedUpload->title); ?></a></li>
    <?php endforeach; ?>
  </ol></p>
                  <?php endif; ?>
                  
                  
	
	</div>
   </div> 	
	
</div>

<div class="twoCol2">
		
		<div id="docIconView">
    		<div id="ratingFeedback" class="ui-corner-all" ></div>
    	 <form action="" method="post" accept-charset="utf-8" id="ratingForm" >
         <input type="submit" class="ratingIconGood" name="rating_typeA" value="<?php echo $ratings['positive']; ?>" class="button" onclick="loadGoodVote()"/>
         <input type="submit" class="ratingIconBad" name="rating_typeA" value="<?php echo $ratings['negative']; ?>" class="button" onclick="loadBadVote()"/>
    </form>
                    <div id="reportDialog" title="Report This Study Material as Inappropriate">
	<?php include 'reportcontent.php'; ?>
	</div>
                <div class="reportIconView">Report</div>
                <div class="clear"></div>
                
 <br/> 
     <div class="facebookIconView">
    <div id="fb-root"></div><script src="http://connect.facebook.net/en_US/all.js#appId=227114113981233&amp;xfbml=1"></script><fb:like href="<?php echo site_url('uploads/view/'. $upload->id); ?>" send="false"  layout="box_count" width="100" height="100" show_faces="true" action="recommend" font="tahoma"></fb:like>
    </div>
        <div class="twitterIconView">
    	<a href="http://twitter.com/share" class="twitter-share-button" data-count="vertical" data-via="studygig">Tweet</a><script type="text/javascript" src="http://platform.twitter.com/widgets.js"></script>
    </div>
    
    <div class="clear"></div>
    <br/>
    <div id="fb-root"></div><script src="http://connect.facebook.net/en_US/all.js#xfbml=1"></script><fb:send href="<?php echo site_url('uploads/view/'. $upload->id); ?>" font="tahoma"></fb:send>
    <span style="margin-left:50px;"><g:plusone></g:plusone></span>
    <div class="linkIconView">
    	Link: <input type="textfield" name="uploadLink" size="15"  id="uploadLinkField" value="<?php echo site_url('uploads/view/'. $upload->id); ?>"  onClick="SelectAll('uploadLinkField');" />
    	</div>
    
    </div>
		
    <div class="roundedCornerContent">
                <h2>Similar Material</h2>
            <?php if(empty($similarUploads)){
                echo "No similar study material found.";
            }else{ ?>
                
        <?php foreach($similarUploads as $similarUpload):?>
        <h4><a href="<?php echo site_url('uploads/view/'. $similarUpload->id);?>"><?php echo htmlspecialchars($similarUpload->title); ?></a></h4>
    <?php endforeach; ?>
    <?php } ?>
        </div>
                
    
    <div class="roundedCornerContent">
                <h2>More from this user</h2>
            <?php if(empty($byUserUploads)){
                echo "No more study material from this user found.";
            }else{ ?>
                
        <?php foreach($byUserUploads as $moreUpload):?>
        <h4><a href="<?php echo site_url('uploads/view/'. $moreUpload->id);?>"><?php echo htmlspecialchars($moreUpload->title); ?></a></h4>
    <?php endforeach; ?>
    <?php } ?>
	</div>
</div>
</div>
<script type="text/javascript" src="https://apis.google.com/js/plusone.js"></script>
<script type="text/javascript">    

	$(function() {
		var reason = $( "#reportReason" ),
			additionalinfo = $( "#reportAdditionalInfo" ),
			allFields = $( [] ).add( reason ).add( additionalinfo ),
			tips = $( ".validateTips" );
			
		$( "#reportDialog" ).dialog({
			autoOpen: false,
			height: 400,
			width: 550,
			modal: true,
			buttons: {
				"Flag This Material": function() {
					
					var bValid = true;
					bValid = bValid && (reason.val() != 0);
					
					
					if ( bValid ) {						
						$.post( "<?php echo site_url('flags/add');?>", { reportReason: reason.val(), 
							reportAdditionalInfo : additionalinfo.val(),
							upload_id: "<?php echo $upload->id;?>",
							type: 0},
					      function( data ) {
					      	 $("#ratingFeedback").css("visibility","visible");
					      	document.getElementById("ratingFeedback").innerHTML=data;
					      }
					    );
						$( this ).dialog( "close" );
					}
				},
				Cancel: function() {
					$( this ).dialog( "close" );
				}
			},
			close: function() {
				allFields.val( "" ).removeClass( "ui-state-error" );
			}

		});

		$( ".reportIconView" ).click(function() {
			$( "#reportDialog" ).dialog( "open" );
			return false;
		});
	});

  function loadGoodVote(){
  	/* attach a submit handler to the form */
  $("#ratingForm").submit(function(event) {
	
    /* stop form from submitting normally */
    event.preventDefault(); 
  });
  	
  	 /* Send the data using post and put the results in a div */
    $.post( "<?php echo site_url('ratings/add');?>", { rating_type: "1", upload_id: "<?php echo $upload->id;?>"},
      function( data ) {
      	$("#ratingFeedback").css("visibility","visible");
      	document.getElementById("ratingFeedback").innerHTML=data;
         $(".ratingIconGood").css("background-position","left bottom");
         $(".ratingIconGood").css("color","#009b00");
         $('.ratingIconGood').attr('value', ' <?php echo $ratings['positive'] + 1;?>');
      }
    );
  }
  
    function loadBadVote(){
  	/* attach a submit handler to the form */
  $("#ratingForm").submit(function(event) {
	
    /* stop form from submitting normally */
    event.preventDefault(); 
  });
  	
  	 /* Send the data using post and put the results in a div */
    $.post( "<?php echo site_url('ratings/add');?>", { rating_type: "0", upload_id: "<?php echo $upload->id;?>"},
      function( data ) {
      	$("#ratingFeedback").css("visibility","visible");
      	document.getElementById("ratingFeedback").innerHTML=data;
         $(".ratingIconBad").css("background-position","left bottom");
         $(".ratingIconBad").css("color","#9b0000");
         $('.ratingIconBad').attr('value', ' <?php echo $ratings['negative'] + 1;?>');
      }
    );
  }
  

    function SelectAll(id)
{
    document.getElementById(id).focus();
    document.getElementById(id).select();
}
</script>
