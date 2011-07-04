<script>
$(function () {
  
  var msie6 = $.browser == 'msie' && $.browser.version < 7;
  
  if (!msie6) {
    var top = $('#aboutUsNav').offset().top - parseFloat($('#aboutUsNav').css('margin-top').replace(/auto/, 0));
    $(window).scroll(function (event) {
      // what the y position of the scroll is
      var y = $(this).scrollTop();
      
      // whether that's below the form
      if (y >= top) {
        // if so, ad the fixed class
        $('#aboutUsNav').addClass('fixed');
      } else {
        // otherwise remove it
        $('#aboutUsNav').removeClass('fixed');
      }
    });
  }  
});
</script>

<div id="aboutUsNavWrapper">
<ul id="aboutUsNav">
	<li><a href="aboutus#siteAnchor">About Studygig</a></li>
	<li><a href="tenreasons#siteAnchor">9 Reasons...</a></li>
	<li><a href="help#siteAnchor">FAQs & Help</a></li>
	<li><a href="http://studygig.posterous.com/">Blog</a></li>
	<li><a href="academicintegrity#siteAnchor">Academic Integrity</a></li>
	<li><a href="copyright#siteAnchor">Copyright Notice</a></li>
	<li><a href="termsofuse#siteAnchor">Terms of Use</a></li>
	<li><a href="privacy#siteAnchor">Privacy Policy</a></li>
	<li><a href="contact#siteAnchor">Contact Us</a></li>
</ul>
</div>