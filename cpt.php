<?php
   /*
   Plugin Name: Extending My WordPress Project
   Plugin URI: Register Custom Post type, custom taxonomies and my custom field
   Description: a plugin to register your CPT, custom taxomomies and custom fields.
   Version: 1
   Author: Vasilis Baimas
   Author URI: https://github.com/vbaimas/CPT-Olympus
   License: GPL2
   */

/*
 ██████╗██████╗ ████████╗
██╔════╝██╔══██╗╚══██╔══╝
██║     ██████╔╝   ██║   
██║     ██╔═══╝    ██║   
╚██████╗██║        ██║   
 ╚═════╝╚═╝        ╚═╝ 
 */

function custom_post_books() { 
  register_post_type( 'wcp_books',
    array('labels' => array(
      'name' => __('Books', 'post type general name'), /* This is the Title of the Group */
      'singular_name' => __('Books', 'post type singular name'),  /* This is the individual type */
      'add_new' => __('Add a New Book'), /* The add new menu item */
      'add_new_item' => __('Add New Book'), /* Add New Display Title */
      'edit' => __( 'Edit' ), /* Edit Dialog */
      'edit_item' => __('Edit Book'),/* Edit Display Title */
      'new_item' => __('New Book'), /* New Display Title */
      'view_item' => __('View Book'), /* View Display Title */
      'search_items' => __('Search Books'), /* Search Custom Type Title */ 
      'not_found' =>  __('Sorry, there are no Books to be found.'), /* This displays if there are no entries yet */ 
      'not_found_in_trash' => __('Nope, no Book in the Trash'),/* This displays if there is nothing in the trash */
      ), /* end of arrays */

      'description' => __( 'This is a custom post type called Book' ), 
      'public' => true, /* Do you want this CPT viewable to the public on the front end? */
      'publicly_queryable' => true,  /* Do you want this CPT to be searchable in the front-end search */
      'exclude_from_search' => false, /* Do you want this CPT to turn up in search results? */
      'has-archive' => false,  /* Whether the post type has an index/archive/root page like the "page for posts" for regular 
      * posts. If set to TRUE, the post type name will be used for the archive slug.  You can also 
      * set this to a string to control the exact name of the archive slug.*/
      'show_ui' => true,  /* Do you want this CPT to have an admin in the back-end? */
      'menu_position' =>5, /* An integer to position the post type menu." */ 
      'rewrite' => array('slug'=>'books'),/* you can define the slug for your CPT, by default it will be your CPT's name which isn't always pretty */ 
      'menu_icon' => 'dashicons-category', /* the icon for the custom post type menu using Dashicons https://developer.wordpress.org/resource/dashicons/ */
      /* the next one is important, it tells what's enabled in the post editor. Your options are:
      'title', 'editor', 'author', 'thumbnail', 'excerpt', 'trackbacks', 'custom-fields', 'comments', 'revisions', 'page-attributes', 'post-formats' */
      'supports' => array( 'title', 'thumbnail', 'excerpt'),
      'taxonomies' => array('type', 'publisher'), /*An array of registered taxonomies that this post type can use.*/
      'capability_type' => 'page', /*
         * A string used to build the edit, delete, and read capabilities for posts of this type. You 
         * can use a string or an array (for singular and plural forms).  The array is useful if the 
         * plural form can't be made by simply adding an 's' to the end of the word.  For example, 
         * array( 'box', 'boxes' ).*/
      'hierarchical' => true /*A boolean value to decide if this post type can be assigned to categories/tags. */
    ) 
  ); 
} 
add_action( 'init', 'custom_post_books');


/*
████████╗ █████╗ ██╗  ██╗               ██████╗ █████╗ ████████╗███████╗ ██████╗  ██████╗ ██████╗ ██╗███████╗███████╗
╚══██╔══╝██╔══██╗╚██╗██╔╝              ██╔════╝██╔══██╗╚══██╔══╝██╔════╝██╔════╝ ██╔═══██╗██╔══██╗██║██╔════╝██╔════╝
   ██║   ███████║ ╚███╔╝     █████╗    ██║     ███████║   ██║   █████╗  ██║  ███╗██║   ██║██████╔╝██║█████╗  ███████╗
   ██║   ██╔══██║ ██╔██╗     ╚════╝    ██║     ██╔══██║   ██║   ██╔══╝  ██║   ██║██║   ██║██╔══██╗██║██╔══╝  ╚════██║
   ██║   ██║  ██║██╔╝ ██╗              ╚██████╗██║  ██║   ██║   ███████╗╚██████╔╝╚██████╔╝██║  ██║██║███████╗███████║
   ╚═╝   ╚═╝  ╚═╝╚═╝  ╚═╝               ╚═════╝╚═╝  ╚═╝   ╚═╝   ╚══════╝ ╚═════╝  ╚═════╝ ╚═╝  ╚═╝╚═╝╚══════╝╚══════
*/



function themeprefix_categories() {
  // Hierarchal Taxonomy aka Category style - this example uses level
  $labels = array(
    'name'              => _x( 'type', 'taxonomy general name' ),
    'singular_name'     => _x( 'type', 'taxonomy singular name' ),
    'search_items'      => __( 'Search in type' ),
    'all_items'         => __( 'All types' ),
    'most_used_items'   => null,
    'parent_item'       => null,
    'parent_item_colon' => null,
    'edit_item'         => __( 'Edit type' ),
    'update_item'       => __( 'Update type' ),
    'add_new_item'      => __( 'Add new type' ),
    'new_item_name'     => __( 'New type' ),
    'menu_name'         => __( 'type' ),
  );
  $args = array(
    'labels'            => $labels,
    'public'            => true,
    'show_in_nav_menus' => true,
    'show_ui'           => true,
    'show_tagcloud'     => true,
    'hierarchical'      => true, /* if this is yes, it acts like categories */   
    'show_admin_column' => true,
    'query_var'         => type,
    'rewrite'           => array( 'slug' => 'type' ),
  );
  register_taxonomy( 'type', array( 'wcp_books' ), $args );//add in your CPTS that the Taxonomy is applicable to this example links it to regular posts and a 'wcp_courses' custom post type
}
add_action( 'init', 'themeprefix_categories');


  /*
████████╗ █████╗ ██╗  ██╗              ████████╗ █████╗  ██████╗ ███████╗
╚══██╔══╝██╔══██╗╚██╗██╔╝              ╚══██╔══╝██╔══██╗██╔════╝ ██╔════╝
   ██║   ███████║ ╚███╔╝     █████╗       ██║   ███████║██║  ███╗███████╗
   ██║   ██╔══██║ ██╔██╗     ╚════╝       ██║   ██╔══██║██║   ██║╚════██║
   ██║   ██║  ██║██╔╝ ██╗                 ██║   ██║  ██║╚██████╔╝███████║
   ╚═╝   ╚═╝  ╚═╝╚═╝  ╚═╝                 ╚═╝   ╚═╝  ╚═╝ ╚═════╝ ╚══════╝
*/

function themeprefix_tags() {
  // Flat Taxonomy aka Tag like - this example uses Programming language
  $labels = array(
    'name'                       => _x( 'publisher', 'taxonomy general name' ),
    'singular_name'              => _x( 'publisher', 'taxonomy singular name' ),
    'search_items'               => __( 'Search in Publisher' ),
    'all_items'                  => __( 'All Publisher' ),
    'most_used_items'            => null,
    'parent_item'                => null,
    'parent_item_colon'          => null,
    'edit_item'                  => __( 'Edit Publisher' ),
    'update_item'                => __( 'Update Publisher' ),
    'add_new_item'               => __( 'Add new Publisher' ),
    'new_item_name'              => __( 'New Publisher' ),
    'separate_items_with_commas' => __( 'Separate Publisher with commas' ),
    'choose_from_most_used'      => __( 'Choose from the most used Publisher' ),
    'not-found'                  => __( 'No publisher found'),
    'menu_name'                  => __( 'Publisher' ),
  );
  $args = array(
    'labels'                     => $labels,
    'public'                     => true,
    'show_in_nav_menus'          => true,
    'show_ui'                    => true,
    'show_tagcloud'              => true,
    'hierarchical'               => false, /* if this is false, it acts like tags */   
    'show_admin_column'          => true,
    'query_var'                  => publisher,
    'update_count_callback'      => '_update_post_term_count',
    'rewrite'                    => array( 'slug' => 'publisher' ),
  );
  register_taxonomy( 'publisher', array( 'wcp_books'), $args );//add in your CPTS that the Taxonomy is applicable to this example links it to regular posts and a 'wcp_courses' custom post type*/
}
add_action( 'init', 'themeprefix_tags');


//Flush the permalinks - ref - https://codex.wordpress.org/Function_Reference/register_post_type#Flushing_Rewrite_on_Activation
function prefix_my_rewrite_flush() {
    // First, we "add" the custom taxonomies via the above written function.
    // Then we flush the permalinks when the plugin is activated so the new taxonomy archives are readily available.
    themeprefix_taxonomies();
    // ATTENTION: This is *only* done during plugin activation hook in this example!
    // You should *NEVER EVER* do this on every page load!!
    flush_rewrite_rules();
}
register_activation_hook( __FILE__, 'prefix_my_rewrite_flush' );
register_deactivation_hook( __FILE__, 'flush_rewrite_rules' );


/*
███╗   ███╗███████╗████████╗ █████╗     ██████╗  ██████╗ ██╗  ██╗
████╗ ████║██╔════╝╚══██╔══╝██╔══██╗    ██╔══██╗██╔═══██╗╚██╗██╔╝
██╔████╔██║█████╗     ██║   ███████║    ██████╔╝██║   ██║ ╚███╔╝ 
██║╚██╔╝██║██╔══╝     ██║   ██╔══██║    ██╔══██╗██║   ██║ ██╔██╗ 
██║ ╚═╝ ██║███████╗   ██║   ██║  ██║    ██████╔╝╚██████╔╝██╔╝ ██╗
╚═╝     ╚═╝╚══════╝   ╚═╝   ╚═╝  ╚═╝    ╚═════╝  ╚═════╝ ╚═╝  ╚═╝
 */


function themeprefix_fields() {
//Add custom admin Meta Boxes:
add_action('add_meta_boxes', 'add_ians_metaboxes');
function add_ians_metaboxes(){
//add meta box for Instructor type and description:
add_meta_box('meta_box_html_id', 'About the Author', 'names_details_function', 'wcp_books', 'normal', 'high');
}

//##################### Instructor Details Metabox: ################
function names_details_function() {
global $post;  
//Noncename needed to verify where the data originated
echo '<input type="hidden" name="bookmeta_noncename" id="bookmeta_noncename" value="' .
wp_create_nonce(plugin_basename(__FILE__)) . '" />';

//Get List Name description data if its already been entered
$names_list = get_post_meta($post->ID, '_names_list', true);
    
//Start List Name text field HTML:
?>
Author :
<input type="text" name="names_list" value="<?php echo $names_list; ?>" class="widefat" />
<?php
}//end names_details_function

//hook into save_post to save the meta box data:
add_action ('save_post', 'save_names_list');

function save_names_list($post_id) {
//verify the metadata is set
     if (isset( $_POST['names_list'])) {
     //save the metadata
     update_post_meta ($post_id, '_names_list', strip_tags($_POST['names_list']));
     }
}
}
add_action( 'init', 'themeprefix_fields');

?>
