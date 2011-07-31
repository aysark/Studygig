        <div id="content2">
    <div class="twoCol1">
    <?php if($this->session->flashdata('last_search')):?>    
    <a href="#"><img src="../../../images/left-arrow-icon.png" width="16" height="14" alt="Back to search results" /></a> <a href="<?php echo site_url('uploads/getsearchfor/').'/'. $this->session->flashdata('last_search');?>">Back to Search</a>
    <?php endif; ?>
    
    <div class="docViewTitleIcons">
    	
    	<?php if($this->session->userdata('logged_in') && !$favourited): ?>
    	<a href="<?php echo site_url('uploads/favourite/'. $upload->id); ?>"><div id="favIcon">Favourite</div></a>
    	<?php endif; ?><?php if($favourited): ?>
    	<a href="<?php echo site_url('uploads/unfavourite/'. $upload->id); ?>"><div id="favIcon2">Remove</div></a>
    	<?php endif; ?>
    	<a href="<?php echo site_url('uploads/view/'. $upload->id.'#disqus_thread');?>" data-disqus-identifier="<?php echo $upload->id; ?>" id="commIconView"></a>
    </div>
    <h1><?php echo htmlspecialchars($upload->title);?> </h1>
        
    <h5> <img src="../../../images/material<?php echo $materialType; ?>.png" width="75" height="25" alt="Material Type" class="material-type-icon" /> <img src="../../../images/file<?php echo $fileType; ?>.png" width="20" height="20" class="file-type-icon" />
             Uploaded by <?php echo $uploader->username. " on " . date('F j, Y \a\t g:i A', strtotime($upload->created_at));?> in <a href="<?php echo site_url('uploads/getsearchfor/').'/'.substr ($course,0,8);?>"><span class="courseCourseStyle"><?php echo $course;?></span></a></h5> 
    
    
    <div class="docPreview">
        <?php
        if ($upload->filesize == -1){
            echo "This upload is not hosted on Studygig, currently we do not provide previews for such uploads.";
            
        }else if (strcasecmp($upload->filetype,".pdf") != 0)//if not pdf
        {
        	//check if its an image upload
           	 if ((strcasecmp($upload->filetype,".jpg") == 0) || (strcasecmp($upload->filetype,".jpeg") == 0) || (strcasecmp($upload->filetype,".gif") == 0) || (strcasecmp($upload->filetype,".png")== 0)){
                echo "<img src=\"".base_url().$file_path."\" width=\"500\" height=\"500\"/>";
        	 }else{
           echo "Sorry, this file is not .pdf format, it is in ".$upload->filetype." format.  We are unable to provide previews for such file formats for the time being.";
      	 	 }
    
    //its a pdf and has a preview  	 	 
	}else{
   	 	$preview = str_replace($upload->filetype,".jpg",$file_path);
    	echo "<img src=\"".base_url().$preview."\" />";
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
                <p><?php if ($upload->filesize != -1) {echo "This material has a size of ".$upload->filesize."KB"; }?></p>
                <?php if($related): ?>
                <h4>Related Documents <img src="../../../images/help-icon.gif" width="16" height="15" alt="Help Icon" title="These are documents that were uploaded with the above upload- it might be a continuation of the above."/></h4>
                <p>    <ol><?php foreach($moreByUser as $relatedUpload):?>
    	<li><a href="<?php echo site_url('uploads/view/'. $relatedUpload->id);?>"><?php echo htmlspecialchars($relatedUpload->title); ?></a></li>
    <?php endforeach; ?>
  </ol></p>
                  <?php endif; ?>
                  <div id="seperator">
  	</div>
                  <h1>Discuss this Material</h1>
                  <div id="disqus_thread"></div>
                  
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
                <div class="downloadViewButton"> 
               
            <?php echo form_open('uploads/download'); ?>
	    <input type="hidden" id="file_name" name="file_name" value ="<?php echo $file_name; ?>" />
	    <input type="hidden" id="file_path" name="file_path" value ="<?php echo $file_path; ?>" />
	    <input type="hidden" id="upload_id" name="upload_id" value ="<?php echo $upload->id; ?>" />
	    <input type="submit" name="submit" value="Download Document" class="button" id="docViewItButton"/>
	    <?php echo form_close();?>
    
    </div>
    
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
    	Link: <input type="textfield" name="uploadLink" size="20"  id="uploadLinkField" value="<?php echo site_url('uploads/view/'. $upload->id); ?>"  onClick="SelectAll('uploadLinkField');" />
    	</div>
    
    </div>
    	
    <div class="roundedCornerContent">
                <h2>Similar Material</h2>
            <?php if(empty($similarUploads)){
                echo "No similar study material found.";
            }else{ ?>
                
        <?php foreach($similarUploads as $similarUpload):?>
        <h4><a href="<?php echo site_url('uploads/view/'. $similarUpload->id);?>"><?php echo $similarUpload->title; ?></a></h4>
    <?php endforeach; ?>
    <?php } ?>
        </div>
                
    
    <div class="roundedCornerContent">
                <h2>More from this user</h2>
            <?php if(empty($byUserUploads)){
                echo "No more study material from this user found.";
            }else{ ?>
                
        <?php foreach($byUserUploads as $moreUpload):?>
        <h4><a href="<?php echo site_url('uploads/view/'. $moreUpload->id);?>"><?php echo $moreUpload->title; ?></a></h4>
    <?php endforeach; ?>
    <?php } ?>
    </div>
    
    </div>
    
    
    </div><!-- end content div -->
    <script type="text/javascript" src="https://apis.google.com/js/plusone.js"></script>

<script type="text/javascript">  

	$(function() {
		var reason = $( "#reportReason" ),
			additionalinfo = $( "#insertDescription" ),
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
  

    /* * * CONFIGURATION VARIABLES: EDIT BEFORE PASTING INTO YOUR WEBPAGE * * */
    var disqus_shortname = 'studygig'; // required: replace example with your forum shortname
	var disqus_developer = 0;
	var disqus_title = 'Comment';
    // The following are highly recommended additional parameters. Remove the slashes in front to use.
    var disqus_identifier = '<?php echo "u".$upload->id; ?>';
    //var disqus_url = 'http://example.com/permalink-to-page.html';

    /* * * DON'T EDIT BELOW THIS LINE * * */
    (function() {
        var dsq = document.createElement('script'); dsq.type = 'text/javascript'; dsq.async = true;
        dsq.src = 'http://' + disqus_shortname + '.disqus.com/embed.js';
        (document.getElementsByTagName('head')[0] || document.getElementsByTagName('body')[0]).appendChild(dsq);
        
    })();
    
    
    function SelectAll(id)
{
    document.getElementById(id).focus();
    document.getElementById(id).select();
}
</script>
