        <div id="content2">
    <div class="twoCol1">
    <?php if($this->session->flashdata('last_search')):?>    
    <a href="#"><img src="../../../images/left-arrow-icon.png" width="16" height="14" alt="Back to search results" /></a> <a href="<?php echo site_url('uploads/search/').'/'. $this->session->flashdata('last_search');?>">Back to Search</a>
    <?php endif; ?>
    
    <div class="docViewTitleIcons">
    	<a href="<?php echo site_url('classifieds/view/'.  $listing->id.'#disqus_thread');?>" data-disqus-identifier="<?php echo  $listing->id; ?>" id="commIconView"></a>
    </div>
    <h1><?php echo  htmlspecialchars($listing->title);?> </h1>
        
    <h5> <img src="../../../images/material<?php echo $materialType; ?>.png" width="75" height="25" alt="Material Type" class="material-type-icon" /> 
             Posted by <?php echo  $uploader->username. " on " . date('F j, Y \a\t g:i A', strtotime( $listing->created_at));?> in <a href="<?php echo site_url('uploads/search/').'/'.substr ($course,0,8);?>"><span class="courseCourseStyle"><?php echo $course;?></span></a></h5> 
    <div class="docDescription">
                <div class="docContent">
                <p><?php  
    
    			$str = str_replace('\n','<br>',htmlspecialchars($listing->description));
               $str = str_replace('\r','<br>',$str);
               
               echo $str; 
                	
                	?></p>
                
                  <div id="seperator"></div>
                  <h1>Discuss this Material</h1>
                  <div id="disqus_thread"></div>
                  
                </div>
              </div>
    
    </div>
    
    <div class="twoCol2">
    	
    <div id="docIconView">
    	<div id="ratingFeedback" class="ui-corner-all" ></div>
    	<div id="reportDialog" title="Report This Study Material as Inappropriate">
			<?php include 'reportcontent.php'; ?>
		</div>

    	<div class="resultsPrice">
	    	$<?php echo $listing->price; ?>
		</div>
	
		<div class="reportIconView marginTopTen">Report</div>
	
    	<br/>
    	
		<div id="contactDialog" title="Send a Message to the Seller">
			<?php include 'contactseller.php'; ?>
		</div>
   		 <div id="contactSellerButton">Contact Seller</div>
   		 
    <div class="facebookIconView">
    <div id="fb-root"></div><script src="http://connect.facebook.net/en_US/all.js#appId=227114113981233&amp;xfbml=1"></script><fb:like href="<?php echo site_url('classifieds/view/'.  $listing->id); ?>" send="false"  layout="box_count" width="100" height="100" show_faces="true" action="recommend" font="tahoma"></fb:like>
    </div>
        <div class="twitterIconView">
    	<a href="http://twitter.com/share" class="twitter-share-button" data-count="vertical" data-via="studygig">Tweet</a><script type="text/javascript" src="http://platform.twitter.com/widgets.js"></script>
    </div>
    <div class="clear"></div>
    <br/>
    <div id="fb-root"></div><script src="http://connect.facebook.net/en_US/all.js#xfbml=1"></script><fb:send href="<?php echo site_url('classifieds/view/'.  $listing->id); ?>" font="tahoma"></fb:send>
    <span style="margin-left:50px;"><g:plusone></g:plusone></span>
    <div class="linkIconView">
    	Link: <input type="textfield" name="uploadLink" size="20"  id="uploadLinkField" value="<?php echo site_url('classifieds/view/'.  $listing->id); ?>"  onClick="SelectAll('uploadLinkField');" />
    	</div>
    
    </div>
    	
    <div class="roundedCornerContent">
                <h2>Similar Material</h2>
            <?php if(empty($similarUploads)){
                echo "No similar study material found.";
            }else{ ?>
                
        <?php foreach($similarUploads as $similarUpload):?>
        <h4><a href="<?php echo site_url('classifieds/view/'. $similarUpload->id);?>"><?php echo htmlspecialchars($similarUpload->title); ?></a></h4>
    <?php endforeach; ?>
    <?php } ?>
        </div>
                
    
    <div class="roundedCornerContent">
                <h2>More from this user</h2>
            <?php if(empty($byUserUploads)){
                echo "No more study material from this user found.";
            }else{ ?>
                
        <?php foreach($byUserUploads as $moreUpload):?>
        <h4><a href="<?php echo site_url('classifieds/view/'. $moreUpload->id);?>"><?php echo htmlspecialchars($moreUpload->title); ?></a></h4>
    <?php endforeach; ?>
    <?php } ?>
    </div>
    
    </div>
    
    
    </div><!-- end content div -->
<script type="text/javascript" src="https://apis.google.com/js/plusone.js"></script>
<script type="text/javascript">  

	$(function() {
		var reason = $( "#reportReason" ),
			additionalinfo = $( "#reportAdditionalInfo" );
			
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
							upload_id: "<?php echo  $listing->id;?>",
							type: 1},
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
		
		var messageToSeller = $( "#insertDescription" );
			
		$( "#contactDialog" ).dialog({
			autoOpen: false,
			height: 400,
			width: 550,
			modal: true,
			buttons: {
				"Send Message": function() {
					
					var bValid = true;
					bValid = bValid && (messageToSeller.val() !=0);
					
					
					if ( bValid ) {						
						$.post( "<?php echo site_url('classifieds/contactSeller');?>", { message: messageToSeller.val(), 	listing_id: "<?php echo  $listing->id;?>"},
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

		$( "#contactSellerButton" ).click(function() {
			$( "#contactDialog" ).dialog( "open" );
			return false;
		});
		
	});

  

    /* * * CONFIGURATION VARIABLES: EDIT BEFORE PASTING INTO YOUR WEBPAGE * * */
    var disqus_shortname = 'studygig'; // required: replace example with your forum shortname
	var disqus_developer = 0;
	var disqus_title = 'Comment';
    // The following are highly recommended additional parameters. Remove the slashes in front to use.
    var disqus_identifier = '<?php echo  "c".$listing->id; ?>';
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
