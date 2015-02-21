<?php get_header(); ?>

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

		         <?php the_content();?>

		         <div class="clearfix"></div>

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