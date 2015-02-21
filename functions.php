<?php

// Register Style
function custom_styles() {

	wp_register_style( 'style-normalize', get_template_directory_uri() . '/css/normalize.css', false, false, 'all' );
	wp_enqueue_style( 'style-normalize' );

	wp_register_style( 'style-main', get_stylesheet_uri(), false, false );
	wp_enqueue_style( 'style-main' );

	wp_register_style( 'style-opensans', 'http://fonts.googleapis.com/css?family=Montserrat|Open+Sans:400,300', false, false );
	wp_enqueue_style( 'style-opensans' );

	wp_register_script( 'html5shiv', get_template_directory_uri() . '/js/html5shiv.js', false, false );
	wp_enqueue_script( 'html5shiv' );

}

if (!is_admin()) add_action("wp_enqueue_scripts", "my_jquery_enqueue", 11);
function my_jquery_enqueue() {
   wp_deregister_script('jquery');
   wp_register_script('jquery', "http" . ($_SERVER['SERVER_PORT'] == 443 ? "s" : "") . "://ajax.googleapis.com/ajax/libs/jquery/1.11.2/jquery.min.js", false, null);
   wp_enqueue_script('jquery');
}

// Hook into the 'wp_enqueue_scripts' action
add_action( 'wp_enqueue_scripts', 'custom_styles' );



function register_my_menus() {
  register_nav_menus(
    array(
      'header-menu' => __( 'Header Menu' ),
      'mobile-menu' => __( 'Mobile Menu' ),
      'footer-menu' => __( 'Footer Menu' )
    )
  ); 
}
add_action( 'init', 'register_my_menus' );

function add_quote_button( $items, $args ) {

    $templateurl = get_bloginfo('template_url');
    if ($args->theme_location == 'header-menu') {
        $items .= '
        <li id="menu-item-quote" class="menu-item-quote"><a href="#">Get a Quote</a>
        ';
    }

    return $items;
}

add_filter( 'wp_nav_menu_items','add_quote_button', 10, 2 );

function form_submit_callback ($name, $tel, $select, $return) {
	if ($name !=='' && $tel !=='' && $select !=='') {
		$return = 'Yes';
	}
	else {
		$return = 'No';
	}

	return $return;
}

//Featured Images

if ( function_exists( 'add_theme_support' ) ) { 
  add_theme_support( 'post-thumbnails' );
  set_post_thumbnail_size( 960, 400 );
  add_image_size( 'page-image', 960, 400, true); 
}

if ( function_exists( 'add_theme_support' ) ) { 
  add_theme_support( 'post-thumbnails2' );
  set_post_thumbnail_size( 200, 150 );
  add_image_size( 'news-homepage', 200, 150, true); 
}

if ( function_exists( 'add_theme_support' ) ) { 
  add_theme_support( 'post-thumbnails3' );
  set_post_thumbnail_size( 500, 281 );
  add_image_size( 'service', 500, 281, true); 
}

// Short Excerpt 
function get_the_short_excerpt(){
    $permalink = get_permalink();
    $title = get_the_title();
    $excerpt = get_the_excerpt();
    $excerpt = strip_shortcodes($excerpt);
    $excerpt = strip_tags($excerpt);
    $the_str = "<p>";
    $the_str .= substr($excerpt, 0, 200);
    $the_str .= "... </p>";
    $the_str .= <<< EOD
        <a class="button-link button-link-blue" href="$permalink" title="$title"> Read More </a>
EOD;
    return $the_str;
}

// Sharing Links
function get_sharinglinks(){
  $sharingtitle = get_the_title();
  $sharinglink = get_permalink();
  $sharingimage = wp_get_attachment_url( get_post_thumbnail_id($post->ID) );
  $uri_title = utf8_uri_encode($sharingtitle);
  $uri_link = utf8_uri_encode($sharinglink);
  $uri_image = utf8_uri_encode($sharingimage);

  $sharing = '<a class="share-link share-twitter" href="https://twitter.com/intent/tweet?text=' . $sharingtitle . '&url=' . $sharinglink . '/&via=buyerguidemortgages" title="Share on Twitter">Twitter</a>
  <a class="share-link share-facebook" href="https://facebook.com/sharer/sharer.php?u='.$sharinglink.'" title="Share on Facebook">Facebook</a>
  <a class="share-link share-googleplus" href="https://plus.google.com/share?url='.$sharinglink.'" title="Share on Google+">Google+</a>
  <a class="share-link share-pinterest" href="http://pinterest.com/pin/create/button/?url='.$uri_link.'&media='.$uri_image.'&description='.$uri_title.'">Pinterest</a>';

  return $sharing;
}

//Prevent images attachment

function remove_media_link( $form_fields, $post ) {

        unset( $form_fields['url'] );

              return $form_fields;

}

add_filter( 'attachment_fields_to_edit', 'remove_media_link', 10, 2 );

// Home Post

// Register Custom Post Type
function home_post() {

  $labels = array(
    'name'                => _x( 'Homes', 'Post Type General Name', 'text_domain' ),
    'singular_name'       => _x( 'Home', 'Post Type Singular Name', 'text_domain' ),
    'menu_name'           => __( 'Homes', 'text_domain' ),
    'parent_item_colon'   => __( 'Parent Home:', 'text_domain' ),
    'all_items'           => __( 'All Homes', 'text_domain' ),
    'view_item'           => __( 'View Home', 'text_domain' ),
    'add_new_item'        => __( 'Add New Home', 'text_domain' ),
    'add_new'             => __( 'Add New', 'text_domain' ),
    'edit_item'           => __( 'Edit Home', 'text_domain' ),
    'update_item'         => __( 'Update Home', 'text_domain' ),
    'search_items'        => __( 'Search Home', 'text_domain' ),
    'not_found'           => __( 'Not found', 'text_domain' ),
    'not_found_in_trash'  => __( 'Not found in Trash', 'text_domain' ),
  );
  $rewrite = array(
    'slug'                => 'home',
    'with_front'          => true,
    'pages'               => true,
    'feeds'               => true,
  );
  $args = array(
    'label'               => __( 'home_post', 'text_domain' ),
    'description'         => __( 'Displays Home Information', 'text_domain' ),
    'labels'              => $labels,
    'supports'            => array( 'title', 'editor', 'excerpt', 'thumbnail', 'custom-fields', ),
    'taxonomies'          => array( 'category', 'post_tag' ),
    'hierarchical'        => false,
    'public'              => true,
    'show_ui'             => true,
    'show_in_menu'        => true,
    'show_in_nav_menus'   => true,
    'show_in_admin_bar'   => true,
    'menu_position'       => 5,
    'menu_icon'           => 'http://i.imgur.com/T3qblb3.png',
    'can_export'          => true,
    'has_archive'         => true,
    'exclude_from_search' => false,
    'publicly_queryable'  => true,
    'rewrite'             => $rewrite,
    'capability_type'     => 'post',
  );
  register_post_type( 'home_post', $args );

}

// Hook into the 'init' action
add_action( 'init', 'home_post', 0 );


// Meta Boxes
$meta_box = array(
    'id' => 'wsk-property-details',
    'title' => 'Property Details Box',
    'page' => 'home_post',
    'context' => 'normal',
    'priority' => 'high',
    'fields' => array(
        array(
            'name' => 'Property Cost',
            'desc' => 'Enter Property Cost. (Do not enter any £ or , these are added automatically.)',
            'id' => '_homecost',
            'type' => 'text',
            'std' => ''
        ),
        array(
            'name' => 'Bedrooms',
            'desc' => 'Enter Number of Bedrooms',
            'id' => '_homebedrooms',
            'type' => 'text',
            'std' => ''
        ),
        array(
            'name' => 'Rooms',
            'desc' => 'List Rooms (1 room per line outputs as a list)',
            'id' => '_homerooms',
            'type' => 'textarea',
            'std' => ''
        ),
        array(
            'name' => 'Address Line 1',
            'desc' => 'Please Enter Line 1 of the Address (Usually the road)',
            'id' => '_homeaddress1',
            'type' => 'text',
            'std' => ''
        ),
        array(
            'name' => 'Address Line 1',
            'desc' => 'Please Enter Line 2 of the Address (Usually the town)',
            'id' => '_homeaddress2',
            'type' => 'text',
            'std' => ''
        ),
        array(
            'name' => 'City',
            'desc' => 'Please Enter the City of the Address',
            'id' => '_homeaddresscity',
            'type' => 'text',
            'std' => ''
        ),        
        array(
            'name' => 'PostCode',
            'desc' => 'Please Enter the PostCode of the Property',
            'id' => '_homelocation',
            'type' => 'text',
            'std' => ''
        ),
        
    )
);

// Add Recipes Meta Boxes
add_action('admin_menu', 'wsk_add_property_meta');
// Add meta box
function wsk_add_property_meta() {
    global $meta_box;
    add_meta_box($meta_box['id'], $meta_box['title'], 'wsk_show_property_box', $meta_box['page'], $meta_box['context'], $meta_box['priority']);
}

// Callback function to show recipe fields in meta box - NEEDS TO MATCH FIELDS ABOVE
function wsk_show_property_box() {
    global $meta_box, $post;
    // Use nonce for verification
    echo '<input type="hidden" name="wsk_property_meta_box_nonce" value="', wp_create_nonce(basename(__FILE__)), '" />';
    echo '<table class="form-table">';
    foreach ($meta_box['fields'] as $field) {
        // get current post meta data
        $meta = get_post_meta($post->ID, $field['id'], true);
        echo '<tr>',
                '<th style="width:20%"><label for="', $field['id'], '">', $field['name'], '</label></th>',
                '<td>';
        switch ($field['type']) {
            case 'text':
                echo '<input type="text" name="', $field['id'], '" id="', $field['id'], '" value="', $meta ? $meta : $field['std'], '" size="30" style="width:97%" />', '<br />', $field['desc'];
                break;
            case 'textarea':
                echo '<textarea name="', $field['id'], '" id="', $field['id'], '" cols="60" rows="4" style="width:97%">', $meta ? $meta : $field['std'], '</textarea>', '<br />', $field['desc'];
                break;
            case 'select': //not currently used but available if needed
                echo '<select name="', $field['id'], '" id="', $field['id'], '">';
                foreach ($field['options'] as $option) {
                    echo '<option ', $meta == $option ? ' selected="selected"' : '', '>', $option, '</option>';
                }
                echo '</select>';
                break;
            case 'radio': //not currently used but available if needed
                foreach ($field['options'] as $option) {
                    echo '<input type="radio" name="', $field['id'], '" value="', $option['value'], '"', $meta == $option['value'] ? ' checked="checked"' : '', ' />', $option['name'];
                }
                break;
            case 'checkbox': //not currently used but available if needed
                echo '<input type="checkbox" name="', $field['id'], '" id="', $field['id'], '"', $meta ? ' checked="checked"' : '', ' />';
                break;
        }
        echo     '</td><td>',
            '</td></tr>';
    }
    echo '</table>';
}

add_action('save_post', 'wsk_save_property_data');
// Save data from meta box
function wsk_save_property_data($post_id) {
    global $meta_box;
    // verify nonce
    if (!wp_verify_nonce($_POST['wsk_property_meta_box_nonce'], basename(__FILE__))) {
        return $post_id;
    }
    // check autosave
    if (defined('DOING_AUTOSAVE') && DOING_AUTOSAVE) {
        return $post_id;
    }
    // check permissions
    if ('home_post' == $_POST['post_type']) {
        if (!current_user_can('edit_page', $post_id)) {
            return $post_id;
        }
    } elseif (!current_user_can('edit_post', $post_id)) {
        return $post_id;
    }

    foreach ($meta_box['fields'] as $field) {
        $old = get_post_meta($post_id, $field['id'], true);
        $new = $_POST[$field['id']];
        if ($new && $new != $old) {
            update_post_meta($post_id, $field['id'], $new);
        } elseif ('' == $new && $old) {
            delete_post_meta($post_id, $field['id'], $old);
        }
    }
}