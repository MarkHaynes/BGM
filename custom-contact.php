<?php
/*
Template Name: Custom Contact Page
*/
?>

<?php get_header(); ?>

<?php
		function stripcleantohtml($s){
	
			return htmlentities(trim(strip_tags(stripslashes($s))), ENT_NOQUOTES, "UTF-8");
		}

		$complete = false;

 		if (isset($_POST['submit'])) {
 			$human = stripcleantohtml($_POST['txtHuman']);

 			if ($human == "Buyer Guide Mortgages" || $human == "Buyer Guide Mortgage" || $human == "BGM" || $human == "Buyers Guide Mortgages" || $human == "Buyers Guide Mortgage") {

 				$humanConfirm = true;
	 			$requiredField = array($_POST['txtFullname'], $_POST['txtTelephone'], $_POST['txtEnquiry']);
	 			$errorRequired = array();
	 			$errorMessage = array();

	 			foreach ($requiredField as $key => $value) {
	 				if (empty($value)) {
	 					$errorRequired [] = $value;
	 				}
	 			}

	 			if (in_array($_POST['txtFullname'], $errorRequired)) {
	 				$errorMessage[] = "We need to know who you are, can you provide your name?";
	 			}
	 			if (in_array($_POST['txtTelephone'], $errorRequired)) {
	 				$errorMessage[] = "We need to be able to contact you, a phone number would be great.";
	 			}
	 			if (in_array($_POST['txtEnquiry'], $errorRequired)) {
	 				$errorMessage[] = "Can you provide us some details of the service your looking for?";
	 			}

	 			if (empty($errorRequired)) {
	 				
	 				$email_message = "<style>label {display:block;}</style>";

	 				$email_message .= "<h1>";
					$email_message .= "Buyer Guide Mortgage Enquiry";
					$email_message .= "</h1>";
					$email_message .= "\n\n\n\n";

					$email_message .= "<label>Fullname:<br>";
					$email_message .= stripcleantohtml($_POST['txtFullname']);
					$email_message .= "</label>";
					$email_message .= "<br>";

					$email_message .= "<label>Email:<br>";
					$email_message .= stripcleantohtml($_POST['txtEmail']);
					$email_message .= "</label>";
					$email_message .= "<br>";

					$email_message .= "<label>Telephone:<br>";
					$email_message .= stripcleantohtml($_POST['txtTelephone']);
					$email_message .= "</label>";
					$email_message .= "<br>";

					$email_message .= "<label>Address:<br>";
					$email_message .= stripcleantohtml(nl2br($_POST['txtAddress']));
					$email_message .= "</label>";
					$email_message .= "<br>";

					$email_message .= "<h1>Enquiry:</h1>";
					$email_message .= stripcleantohtml(nl2br($_POST['txtEnquiry']));
					$email_message .= "<br>";

					$email_message .= "<h2> Please contact the client ASAP by: </h2>";
					$email_message .= "<br>";

					$email_message .= "<label>Call:<br>";
					$email_message .= $_POST['chkCall'];
					$email_message .= "</label>";
					$email_message .= "<br>";

					$email_message .= "<label>Email:<br>";
					$email_message .= $_POST['chkEmail'];
					$email_message .= "</label>";
					$email_message .= "<br>";

					$email_message .= "<label>Post:<br>";
					$email_message .= $_POST['chkPost'];
					$email_message .= "</label>";
					$email_message .= "<br>";

					$email_message .= "<label>When to call:<br>";
					$email_message .= stripcleantohtml($_POST['txtTime']);
					$email_message .= "</label>";
					$email_message .= "<br>";

					$email_message .= "<br>";
					$email_message .= "Please contact them soon!";			


	 				$message = $email_message;
				    $to = "hello@pixellocker.co.uk"; 
				    $from = "hello@pixellocker.co.uk"; 
				    $subject = "Buyer Guide Mortgage - Website Enquiry"; 

					$headers = "From: " . $from . "\r\n";
					$headers .= "Reply-To: ". $to . "\r\n";
					$headers .= "MIME-Version: 1.0\r\n";
					$headers .= "Content-Type: text/html; charset=ISO-8859-1\r\n";




				   // now we just send the message
				   if (@mail($to, $subject, $message, $headers)){
				   	$completed =  true;
				   }
				      
				   else{
				      $error = "There has been a problem sending your message.";
				   }

	 			}
	 			else {
					$error =  "There has been a problem sending your message.";
				}
	 		}
	 		else {
	 			$error =  "Well this is odd, you failed our Human test :( Try again and enter Buyer Guide Mortgages as our Company name.";
	 		}
	 	}
 	?>

<main>

	<section id="main-content">
		<div class="inner-wrapper">

      		<?php if (has_post_thumbnail( $post->ID ) ){ ?>
        	<?php $featuredImage = wp_get_attachment_image_src( get_post_thumbnail_id( $post->ID ), 'page-image' );?>
          	<img class="featured-image" src="<?php echo $featuredImage[0]; ?>" alt="<?php echo the_title();?>">      
              
            <?php } else {?>
             <img class="featured-image" src="<?php bloginfo("template_url");?>/images/default.jpg" alt="Buyer Guide Mortgages">
            <?php } ?>


		<?php if ( have_posts() ) : while ( have_posts() ) : the_post(); ?>


		      <article class="post-page">
		        <h1 class="single-title"><?php the_title();?></h1>
		              
		        <hr>
		        
		        <div class="page-content">
				<?php 

					if ($completed == true) { ?>
							<div style="text-align: center;">
								<h1 class="title">Thank you for contacting us, we are excited to contact you shortly.</h1>
							</div>
					<?php }
						
					else {
				?>
				<ul class="formError">

					<?php echo $error;?>
						<?php 

						if (!empty($errorMessage)) {

							echo "<br>";
							foreach ($errorMessage as $key => $value) {
								echo "<li>" . $value . "</li>";
							} 
					}?>

				</ul>
				<div class="contact-left">
					<h2> Please Enter Your Details Below </h2>
			   		<form id="frmContact" action="#" method="post">
				   		<label>
				   			Full Name:<br>
				   			<input name="txtFullname" type="text"  autofocus value="<?php echo stripcleantohtml($_POST['txtFullname']);?>">
				   		</label>
				   		<br>

				   		<label>
				   			Email Address:<br>
				   			<input name="txtEmail" type="email" value="<?php echo stripcleantohtml($_POST['txtEmail']);?>">
				   		</label>
				   		<br>

				   		<label>
				   			Telephone:<br>
				   			<input name="txtTelephone" type="tel"  value="<?php echo stripcleantohtml($_POST['txtTelephone']);?>">
				   		</label>
				   		<br>

				   		<label>
				   			Your Address:<br>
				   			<textarea name="txtAddress" ><?php echo stripcleantohtml($_POST['txtAddress']);?></textarea>
				   		</label>
				   		<br>

				   		<label>
				   			Your Enquiry: <br>
				   			(Please detail the nature of your enquiry or ask us to give you call.)<br>
				   			<textarea name="txtEnquiry" ><?php echo stripcleantohtml($_POST['txtEnquiry']);?></textarea>
				   		</label>
				   		<br>

				   		<label>How would you like us to get in touch?<br></label><br>
				   			<input name="chkCall" id="chkCall"  value="Yes" type="checkbox"><label for="chkCall"><span>Phone</span></label><br>
				   			<input name="chkEmail" id="chkEmail" value="Yes" type="checkbox"><label for="chkEmail"><span>Email</span></label><br>
				   			<input name="chkPost" id="chkPost" value="Yes" type="checkbox"><label for="chkPost"><span>Post</span></label><br>
				   		<br>

				   		<label>
				   			What time would be best for us to call you?<br>
				   			<input type="text" name="txtTime" value="<?php echo stripcleantohtml($_POST['txtTime']);?>">
				   		</label>
				   		<br>

				   		<?php if ($humanConfirm == true) {
				   				echo '<div style="display:none;">';
				   			}
				   			 else {
				   			 	echo '<div style="display:block;">'; 
				   			}
				   		?>

					   		<label class="required">
					   			Just to check your Human, what's the name of OUR Company? Hint Buyer...<br>
					   			<input type="text" name="txtHuman" value="<?php echo stripcleantohtml($_POST['txtHuman']);?>">
					   		</label>
					   		<br>

				   		</div>

				   		<label>
				   			<input name="submit" type="Submit" value="Send Enquiry">
				   		</label>

			   		</form>
 					<?php } ?>

			   		<div style="clear:both"></div>
			   	</div>

			   	<div class="contact-right">

			   		<h2> Contact Us </h2>

			   		<ul>
			   			<li> <strong>Email: <br></strong> <email><a href="mailto:hello@buyerguidemortgagesltd.co.uk">hello@buyerguidemortgagesltd</a></email><br></li>
			   			<li> <strong>Telephone: <br> </strong> 0800 123 123<br><br></li>
			   			<li> <strong>Address:</strong> <address>Line 1<br> Line 2<br>Line 3<br> Post Code</address><strong></li>
			   			<li><strong>Social Networks:</strong><br> Twitter: <a href="http://twitter.com/buyerguidemortgages" title="Twitter">@buyerguidemortgages</a></li>

			   		</ul>

			   		<br> 

			   		<script type="text/javascript" src="http://maps.google.com/maps/api/js?sensor=false"></script><div id="gmap_canvas" style="height:300px;width:250px;"></div><style>#gmap_canvas img{max-width:none!important;background:none!important}</style><script type="text/javascript"> function init_map(){var myOptions = {zoom:11,center:new google.maps.LatLng(53.39125569999999,-3.1784084999999322),mapTypeId: google.maps.MapTypeId.ROADMAP};map = new google.maps.Map(document.getElementById("gmap_canvas"), myOptions);marker = new google.maps.Marker({map: map,position: new google.maps.LatLng(53.39125569999999, -3.1784084999999322)});infowindow = new google.maps.InfoWindow({content:"<b>Buyer Guide Mortgages</b><br/>10 Market Street<br/>CH47 2AE Wirral" });google.maps.event.addListener(marker, "click", function(){infowindow.open(map,marker);});infowindow.open(map,marker);}google.maps.event.addDomListener(window, 'load', init_map);</script>
			   	</div>

		         <div style="clear:both"></div>

		        </div>
		    </article>
		<?php endwhile; else: ?>
      
        <?php endif; ?>


		</div>
	</section>
	 
	<section class="single-sharing">
		<div class="inner-wrapper">
          <h3>Share On</h3>
            <div class="single-sharing-buttons">
            <?php $share = get_sharinglinks();
            echo $share;?>
          </div>  
        </div>
    </section> 

	<section id="faster-quote">
		<a name="faster-quote"></a> 
		<div class="inner-wrapper">
			<div class="text-wrap-left">
				<h2> WANT A FASTER QUOTE?</h2><br>
				<p>Just answer a few simple questions and we will contact you with a tailored quote.</p>
			</div>
			<div class="text-wrap-right">
				<a id="faster-quote-link" class="faster-quote-link" href="#faster-quote"> GET A FASTER QUOTE!</a>
			</div>

			<div class="clear:both"></div>
		</div>
	</section>

	<section id="faster-quote-form">
		<div class="inner-wrapper">
			<h2> Please enter the following details. </h2>
			<form id="form-faster-quote" action="">

				<label class="group">
					Full Name:
					<input type="text" id="input-name" name="name" value="Enter Your Name">
				</label>
				<br>
				<label class="group">
					Telephone Number:
					<input type="tel" id="input-phone" name="phone" value="Enter Telephone No">
				</label>
				<br>
				<label class="group">
					Mortgage Type:
					<select>
						<option value="First Time Buyer">First Time Buyer</option>
						<option value="Home Mover">Home Mover</option>
						<option value="Help To Buy Purchase">Help To Buy Purchase</option>
						<option value="Remortgage">Remortgage</option>
						<option value="Buy To Let">Buy To Let</option>
						<option value="Shared Ownership">Shared Ownership</option>
						<option value="Government Scheme">Government Scheme</option>
					</select>
				</label>				
				<br>
				<label class="group">
					Property Value:
					<input type="text" id="input-value" name="input-value" value="Property Value">
				</label>
				<br>
				<label class="group">
					Mortgage Amount:
					<input type="text" id="input-mortage-amount" name="input-mortage-amount" value="Mortgage Amount">
				</label>
				<br>
				<label class="group">
					Employment:
					<select>
						<option value="Employed">Employed</option>
						<option value="Self-Employed">Self-Employed</option>
						<option value="No provable Income">No provable Income</option>

					</select>
				</label class="group">
				<br>
				<label>
					Current Borrowing:
					<select>
						<option value="Credit Cards">Credit Cards</option>
						<option value="Personal Loan">Personal Loan</option>
						<option value="Mortgage(s)">Mortgage(s)</option>
						<option value="Other Finance">Other Finance</option>
					</select>
				</label>
				<br>
				<input type="button" name="btn" class="btn-style" value="Request Quote!" />
			</form>
		</div>
	</section>

	<section id="sub-content">
		<div class="inner-wrapper">
			<h2>WHY CHOOSE US?</h2>
			<ul class="why-us">
				<li>
					Item 1
				</li>

				<li>
					Item 2
				</li>

			</ul>
			<a href="" class="button-link">Find out More</a>
		</div>
	</section>

</main>

<?php get_footer(); ?>