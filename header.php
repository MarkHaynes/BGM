<!DOCTYPE html>
<head <?php language_attributes(); ?>>
	<meta charset="<?php bloginfo( 'charset' ); ?>">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="profile" href="http://gmpg.org/xfn/11">
	<link rel="pingback" href="<?php bloginfo( 'pingback_url' ); ?>">

	<?php wp_head(); ?>
</head>

<body>

	<header role="banner">
		<div class="inner-wrapper">
			<img class="header-logo" src="<?php echo get_template_directory_uri() . '/images/logo.png'?>" alt="Buyer Guide Mortgages">
			<p class="tel"> Call Us: 0800 123 123 </p>
		
			<a href="#" class="mobile-menu-link">Menu</a>
		</div>
	</header>
    <nav id="top-nav" role="navigation">
    	<div class="inner-wrapper">
        <?php 
            wp_nav_menu( array( 'theme_location' => 'header-menu', 'sub_menu' => true, 'menu_class' => 'header-menu', 'depth' => 1, ) );                            
            $parent = $post->post_parent;
        ?>
        </div>
	</nav>