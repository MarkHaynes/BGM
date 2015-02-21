<?php
/*
Template Name: Custom Home Page
*/
?>
<?php get_header(); ?>

<main>

	<section id="main-content">
		<div class="inner-wrapper">

            <?php $currentpage = get_page_link($post->ID); 
            	$_GET['page'] = $post->ID;
				$_GET['page'] = htmlspecialchars($_GET['page']);
				$_GET['lowest'] = htmlspecialchars($_GET['lowest']);
				$_GET['highest'] = htmlspecialchars($_GET['highest']);


            	?>



            <div class="sort-options">

            	Sort By: <a href="<?php echo $currentpage?>&sortby=ASC&type=price">Lowest to Hightest Price</a> - <a href="<?php echo $currentpage?>&sortby=DESC&type=price">Highest to Lowest Price</a><br>
            	 <form id="form-rooms" action="" method="get"><label class="label-header">Sort By Number of Bedrooms:</label> <input type="hidden" name="page_id" value="<?= $_GET['page'] ?>" /><input type="text" name="rooms" id="rooms" value="Enter Bedrooms" onClick="this.value=='Enter Bedrooms'?this.value='':this.value;"> <input type="submit" value="Search"></form>
            	 <form id="form-price" action="" method="get"><label class="label-header">Sort By Cost:</label> <input type="hidden" name="page_id" value="<?= $_GET['page'] ?>" /> <label>Lowest Price:</label> <input type="text" name="lowest" id="lowest" value="<?= $_GET['lowest'] ?>" onClick="this.value=='Enter Lowest Price'?this.value='':this.value;"> <label>Highest Price:</label> <input type="text" name="highest" id="highest" value="<?= $_GET['highest'] ?>" onClick="this.value=='Enter Highest Price'?this.value='':this.value;"> <input type="submit" value="Search"></form>

            </div>

            <?php

            $roomnum = htmlspecialchars($_GET['rooms']);
            $roomnum = preg_replace("/[^0-9,.]/", "", $roomnum);
            $sorttype = htmlspecialchars($_GET['type']);

            $lowest = htmlspecialchars($_GET['lowest']);
            $lowest  = preg_replace("/[^0-9.]/", "", $lowest);

            $highest = htmlspecialchars($_GET['highest']);
            $highest = preg_replace("/[^0-9.]/", "", $highest);


            if (!empty($lowest) && !empty($highest)) {
				$args = array(
					'numberposts' => -1,
					'post_type' => 'home_post',
					'meta_query' => array(
						'relation' => 'AND',
						array(
							'key' => '_homecost',
							'value' => $lowest,
							'type' => 'NUMERIC',
							'compare' => '>'
						),
						array(
							'key' => '_homecost',
							'value' => $highest,
							'type' => 'NUMERIC',
							'compare' => '<'
						)
					)
				);
            }

            else {

		        if (empty($roomnum) && empty($sorttype)) {
		        	$args = array(
							'post_type'		=> 'home_post',
							'posts_per_page'	=> -1
					);
				}

				else {

		            if (!empty($roomnum)) {
		            	$args = array(
							'post_type'		=> 'home_post',
							'posts_per_page'	=> -1,
							'meta_key'		=> '_homebedrooms',
							'meta_value'	=>  $roomnum,
							'order'			=> 'ASC'
						);

		            }
		            else {

		            	if (!empty($sorttype)) {
		            		if (strpos($sorttype,'price') !== false) {
		            			$sorttype = '_homecost';
		            		}

		            		elseif (strpos($sorttype,'bedrooms') !== false) {
		            			$sorttype = '_homebedrooms';
		            		}

		            		else {
		            			$sorttype = 'location';
		            		}
		            	}

		            	else {
		            		$sorttype = 'price';
		            	}

		            	$sortorder = htmlspecialchars($_GET['sortby']);

		            	if (!empty($sortorder)) {
		            		if (strpos($sortorder,'ASC') !== false) {
		            			$sortorder = 'ASC';
		            		}

		            		elseif (strpos($sortorder,'DESC') !== false) {
		            			$sortorder = 'DESC';
		            		}

		            		else {
		            			$sortorder = 'ASC';
		            		}
		            	}

		            	else {
		            		$sortorder = 'ASC';
		            	}
		            
			            $args = array(
							'post_type'		=> 'home_post',
							'posts_per_page'	=> -1,
							'meta_key'		=> $sorttype,
							'orderby'		=> 'meta_value_num',
							'order'			=> $sortorder
						);
					} //room num else

				} //room num else
			} //lowest highest
			?>

            <?php $query = new WP_Query( $args ); ?>


		<?php if ( $query->have_posts() ) : ?>

			<?php while ( $query->have_posts() ) : $query->the_post(); ?>


			<article class="home">
				<?php if (has_post_thumbnail( $post->ID ) ){ ?>
	        	<?php $featuredImage = wp_get_attachment_image_src( get_post_thumbnail_id( $post->ID ), 'home-image' );?>
	          	<img class="home-image" src="<?php echo $featuredImage[0]; ?>" alt="<?php echo the_title();?>">      
	              
	            <?php } else {?>
	             <img class="home-image" src="<?php bloginfo("template_url");?>/images/nohome.jpg" alt="Buyer Guide Mortgages">
	            <?php } ?>

	            <div class="home-wrapper">
					<h1 class="home-title"><a href="<?php the_permalink(); ?>" title="<?php the_title_attribute(); ?>"><?php the_title(); ?></a></h1>
					<p><?php echo (get_post_meta($post->ID, "_homeaddress1", true)); ?>, <?php echo (get_post_meta($post->ID, "_homeaddress2", true)); ?>, <?php echo (get_post_meta($post->ID, "_homeaddresscity", true)); ?>, <?php echo (get_post_meta($post->ID, "_homelocation", true)); ?></p>
					<p><?php the_excerpt();?></p>
					<ul class="home-meta-list">
						<li class="home-cost">£<?php echo number_format(get_post_meta($post->ID, "_homecost", true)); ?></li>
						<li class="home-meta"><?php echo get_post_meta($post->ID, "_homebedrooms", true); ?> Bedrooms </li>
						<li class="home-meta">Rooms:<?php echo get_post_meta($post->ID, "_homerooms", true); ?></li>

					</ul>
				</div>
				<div style="clear:both"></div>
			</article>
			

		<?php endwhile; else: ?>
      		<p> Sorry, We have not located any homes within your search query. </p>
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