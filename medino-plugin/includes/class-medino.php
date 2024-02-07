<?php
if ( ! class_exists( 'Medino_Cpt' ) ) :

    class Medino_Cpt {

        function __construct() {

            add_action( 'init', array( $this, 'medino_cpt') );
            add_action( 'init', array( $this, 'medino_category_taxonomy' ) );

        }
    

    /**
     * Register Medino custom post type
     * 
     * @return void
     */

     public function medino_cpt() {
        $labels = array(
            'name'              =>_x( 'Medino', 'Posts type general name', 'softuni' ),
            'singular_name'     =>_x( 'Medino', 'Posts type singular name', 'softuni' ),
            'menu_name'         =>_x( 'Medino', 'Admin menu text', 'softuni' ),
            'name_admin_bar'    =>_x( 'Medino', 'Add new on toolbar', 'softuni' ),
            'add_new'           =>__( 'Add new', 'softuni' ),
            'add_new_item'      =>__( 'Add new Medino', 'softuni' ),
            'new_item'          =>__( 'New Medino', 'softuni' ),
            'edit_item'         =>__( 'Edit Medino', 'softuni' ),
            'view_item'         =>__( 'View Medino', 'softuni' ),
            'all_items'         =>__( 'All Medino', 'softuni' ),

        );

        $args = array(
            'labels'            => $labels,
            'public'            => true,
            'publicly_queryable'=> true,
            'show_ui'           => true,
            'show_in_menu'      => true,
            'query_var'         => true,
            'capability_type'   => 'post',
            'has_archive'       => true,
            'hierarchical'      => false,
            'menu_position'     => null,
            'supports'          => array(
                'title',
                'editor',
                'author',
                'thumbnail',
                'revisions',
            ),
            'show_in_rest'=> true
        );

        register_post_type( 'medino', $args );
     }

     /**
      * Register Category taxonomy for Medino CPT
      * 
      * @return void
      */

      public function medino_category_taxonomy () {
        $labels = array(
            'name' => 'Categories',
            'singular_name' => 'Category',
        );

        $args = array(
            'labels'        => $labels,
            'show_in_rest'  => true,
            'hierarchical'  => true,
        );

        register_taxonomy( 'medino-category', 'medino', $args );
      }
    }

     $medino_cpt = new Medino_Cpt;

    endif;


/**
 * Register meta box(es).
 */

function medino_register_meta_boxes() {
	add_meta_box( 'featured', __( 'Is featured?', 'softuni' ), 'medino_featured_metabox', 'medino', 'side' );
}
add_action( 'add_meta_boxes', 'medino_register_meta_boxes' );

/**
 * Callback meta box(es).
 * 
 * @return void
 */

function medino_featured_metabox ( $post_id ) {
    $checked = get_post_meta( $post_id->ID, 'is_featured', true );
    ?>
    <div>
        <label for='is-featured'>Featured?</label>
        <input id='is-featured' name='isfeatured' type='checkbox' value='1' <?php checked ( $checked ,1 , true ); ?>/>
    </div>
    <?php
}

/**
 * Save post meta.
 * 
 * @return void
 */

function medino_meta_save ( $post_id ) {
  if( empty( $post_id ) ) {
    return;
  }

  $featured = '';

  if( isset( $_POST[ 'isfeatured' ] ) ) {
    $featured = esc_attr( $_POST[ 'isfeatured' ] );
  }

    update_post_meta ( $post_id, 'is_featured', $featured );
}

add_action( 'save_post', 'medino_meta_save' );