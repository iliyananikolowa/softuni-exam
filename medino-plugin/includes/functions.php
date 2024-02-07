<?php

/**
 * Load the plugin asset
 */
function medino_plugin_enqueue_assets() {

$args = array();
    wp_enqueue_script( 'medino-assets-plugin', MEDINO_PLUGIN_ASSETS_DIR . '/js/scripts.js', array( 'jquery' ), '1.1', $args );

    wp_localize_script( 'medino-assets-plugin', 'my_ajax_object' ,
        array(
            'ajax_url' => admin_url( 'admin-ajax.php' ),
        )
    );
}

add_action ( 'wp_enqueue_scripts', 'medino_plugin_enqueue_assets' );

/**
 * Function for AJAX and for add a like
 * 
 * @return void
 */

 function medino_like_button() {


    $post_id = esc_attr ( $_POST [ 'post_id' ] );

    $likes_number =  get_post_meta ( $post_id, 'likes', true );

    if ( empty ( $likes_number ) ) {
        $likes_number = 0;
    }

    //Add custom logic preventing bad users

    update_post_meta ( $post_id, 'likes', $likes_number + 1 );
 }

 add_action ( 'wp_ajax_nopriv_medino_like_button', 'medino_like_button' );
 add_action ( 'wp_ajax_medino_like_button', 'medino_like_button' );



/**
 * Function for AJAX and for add a hate
 * 
 * @return void
 */

 function medino_hate_button() {


    $post_id = esc_attr ( $_POST [ 'post_id' ] );

    $hates_number =  get_post_meta ( $post_id, 'hates', true );

    if ( empty ( $hates_number ) ) {
        $hates_number = 0;
    }

    //Add custom logic preventing bad users

    update_post_meta ( $post_id, 'hates', $hates_number + 1 );
 }

 add_action ( 'wp_ajax_nopriv_medino_hate_button', 'medino_hate_button' );
 add_action ( 'wp_ajax_medino_hate_button', 'medino_hate_button' );


 /**
 * Custom shortcode
 * 
 * @return void
 */

 function show_post_title_by_id( $atts ) {

    $shortcode_atts = shortcode_atts (
        array(
            'id' => ''
        ),
        $atts
    );

    $title = '';

    if( ! empty ( $shortcode_atts['id'] ) ) {
        $title = get_the_title( $shortcode_atts['id'] );
    }
    return $title;
}

add_shortcode('show_post_title', 'show_post_title_by_id');
?>

<?php


//Option page Plugin


function wporg_options_page() {
	add_menu_page(
		'WPOrg',
		'WPorg Options Page',
		'manage_options',
		'wporg',
		'wporg_options_page_html'
	);
}


/**
 * Register our wporg_options_page to the admin_menu action hook.
 */
add_action( 'admin_menu', 'wporg_options_page' );


/**
 * Top level menu callback function
 */
function wporg_options_page_html() {
	// check user capabilities
	if ( ! current_user_can( 'manage_options' ) ) {
		return;
	}

	if ( ! empty( $_POST['medino_save'] ) ) {
        $value = esc_attr ( $_POST['custom_option'] );
        update_option ( 'softuni_options', $value, false );

       
        $option_value = get_option( 'softuni_options' );
    }

	// show error/update messages

	?>
	<div class="wrap">

		<h1><?php echo esc_html( get_admin_page_title() ); ?></h1>
		<form action="" method="post">
			
               <label for="custom_option">Custom Options</label>
               <input type="text" id="custom_option" name="custom_option" value="">            
                <input type="submit" value="Update">
                
                <input type="hidden" name="medino_save" value="1">
		</form>
	</div>
	<?php
}

