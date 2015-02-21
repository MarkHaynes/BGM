
	<footer>
		<div class="inner-wrapper">
			<p>NOTE: YOUR HOME MAY BE REPOSSESSED IF YOU DO NOT KEEP UP REPAYMENTS ON YOUR MORTGAGE.<br>
			There may be a fee for Mortgage Advice. This will depend on your on your circumstances but is typically
			between 0% and 1% of the loan amount payable on application. </p>

			<p>Buyer Guide Mortgages Ltd is authorised and regulated by then Financial Conduct Authority.<br>
			FCA No.306038.
		</div>

		<div style="clear:both"></div>
	</footer>

	<nav id="footer-nav">
		<div class="inner-wrapper">
			<?php 
	            wp_nav_menu( array( 'theme_location' => 'footer-menu', 'sub_menu' => true, 'menu_class' => 'footer-menu', 'depth' => 1, ) );                            
	        ?>
	        <span> &copy 2015 Buyer Guide Mortgages </span>
	    </div>
	</nav>

	<script>
		$(function() {
		   var links = $('a.faster-quote-link').click(function() {
		       $('section#faster-quote-form').fadeIn('slow');
		       $('section#faster-quote').css({"-webkit-box-shadow": "0px 4px 7px 0px rgba(50, 50, 50, 0.50)", "-moz-box-shadow": "0px 4px 7px 0px rgba(50, 50, 50, 0.50)", "box-shadow":"0px 4px 7px 0px rgba(50, 50, 50, 0.50)"});
		       $('section#main-content').css ({"-webkit-box-shadow": "0px -4px 5px 0px rgba(50, 50, 50, 0.40)", "-moz-box-shadow": "0px -4px 5px 0px rgba(50, 50, 50, 0.40)", "box-shadow": "0px -4px 5px 0px rgba(50, 50, 50, 0.40)"});
		   });
		});

		
		$('a.mobile-menu-link').click(function(){
		    var link = $(this);
		    $('nav#top-nav').slideToggle('slow', function() {
		        if ($(this).is(':visible')) {
		             link.text('Close');                
		        } else {
		             link.text('Menu');                
		        }        
		    });       
		});

		$(window).resize(function() {
		    var width = $(document).width();
		    if (width > 800) {
		    	if ($('nav#top-nav').is(':visible')) {

		    	}
		    	else {
		       		$('nav#top-nav').css({"display":"block"});
		       	}
		    }
		    else {
		    	$('nav#top-nav').css({"display":"none"});
		    }

		});      
		

	</script>




</body>
</html>