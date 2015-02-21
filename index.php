<?php get_header(); ?>

<main>
	<section id="call-to-action">
		<h1> MORTGAGE ADVICE <br>
		<span class="tagline">Without The Fuss</span></h1>

		<p>We are here to guide you through the mortgage maze!</p>
		<p>Schedule a callback!</p>

		<form id="form-callback" action="">
			<input type="text" id="input-name" name="name" value="Enter Your Name">
			<input type="tel" id="input-phone" name="phone" value="Enter Telephone No">
			<select>
				<option value="am">am</option>
				<option value="pm">pm</option>
			</select>
		
			<input type="button" name="btn" class="btn-style" value="Request Callback" />


		</form>

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

	<section id="main-content">
		<div class="inner-wrapper">
		<h2 class="title">THE SERVICES WE OFFER.</h2>

			<?php 
			    $this_page_id=$wp_query->post->ID;

			    $child_pages = new WP_Query( array(
			        'post_type'      => 'page', // set the post type to page
			        'posts_per_page' => 10, // number of posts (pages) to show
			        'post_parent' => 12, // enter the post ID of the parent page
			        'no_found_rows'  => true, // no pagination necessary so improve efficiency of loop
			        'order_by' => 'date',
			    ) );

			    if ( $child_pages->have_posts() ) : while ( $child_pages->have_posts() ) : $child_pages->the_post(); ?>
			      	<article class="service-wrap">
				        <h2 class="post-title"><a href="<?php echo get_permalink(); ?>" title="<?php echo get_the_title(); ?>"><?php the_title();?></a></h2>

				        <?php if ( has_post_thumbnail() ) {
				              $image_src = wp_get_attachment_image_src( get_post_thumbnail_id(),'service' );
				                 echo '<a href="'. get_permalink() .'" title="'. get_the_title() .'"><img src="' . $image_src[0]  . '" alt="'. get_the_title() . '"/></a>';
				        }; ?>
				        
				        <div class="excerpt">
				        	<?php echo get_the_short_excerpt(); ?>
				         	<div class="clearfix"></div>

				        </div>
				        
			     	</article>

			    <?php endwhile; else: ?>
			      <p>Sorry, no posts matched your criteria.</p>
			    <?php endif; 

			    wp_reset_postdata();

   			?>
  			<div style="clear:both"></div>
			

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