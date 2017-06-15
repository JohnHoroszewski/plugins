<?php

/**
* Plugin Name: JH Manage Your Post Types
* Description: This plugin will allow you to create your own post types with full control over all aspects of their functionality.
* Author: John Horoszewski
* Version: 0.1
*/ 


// Add the Custom Post Type Page to the WP Admin Dashboard
add_action('admin_menu', 'custom_post_type_page');

function custom_post_type_page() {
	add_menu_page('Custom Post Type Page', 'JH CPT\'s', 'manage_options', 'custom-post-types', 'cpt_settings_page', '');
}


// Grab all form elements to pass to new register_post_type
if( isset($_GET['submit']) )
{
    //be sure to validate and clean your variables

    // Grab Custom Name input
    $cpt_custom_name = htmlentities( $_GET['jh_cpt_function'] );

    /**
     * Take Custom Name input and make all lowercase
     * Trim whitespace from left and right
     * Replace all interior whitespace with _
     * Append _post_type to create Custom Post Type Name
     */
    $cpt_func_name =  str_replace( ' ', '_', trim( strtolower( $cpt_custom_name ) ) ) . '_post_type';
 
    // Custom Post Type Description
    $cpt_desc = htmlentities($_GET['jh_cpt_description']);

    // Trim whitespace from left and right
    $cpt_reg_name = trim($cpt_custom_name);

    // Append s to singular name
    $cpt_plural_name = $cpt_reg_name . 's';

    // Archive Name
    $cpt_archive_name = str_replace( ' ', '-', trim( strtolower( $cpt_custom_name ) ) );

    // Grab wether Page or Post is selected
    $cpt_hier = htmlentities( $_GET['jh_cpt_hierarchical'] );

    // Get all checkboxes for supports, use implode to create string from array, surround string with single quotes and seperate each item with single quotes and a comma
    $cpt_supports = "'" . implode( "','", $_GET['jh_cpt_supports'] ) . "'";

    // Grab list of taxonomies and explode on , 
    $cpt_taxs = explode( ',', $_GET['jh_cpt_tax'] );
    // Use implode to create string from array, surround string with single quotes and seperate each item with single quotes and a comma, make all letters lowercase
    $cpt_tax_array = "'" . strtolower( implode( "','", $cpt_taxs ) ) . "'";

    $result = $cpt_func_name . ' ' . $cpt_desc . ' ' . $cpt_sname . ' ' . $cpt_plural_name . ' ' . $cpt_taxs . ' ' . $cpt_hier;

    if( isset($result) ) echo 

// Register Custom Post Type
"function " . $cpt_func_name . "() {<br>
<br>
    $labels = array(<br>
        'name'                  => _x( '" . $cpt_plural_name . "', 'Post Type General Name', 'text_domain' ),<br>
        'singular_name'         => _x( '" . $cpt_custom_name . "', 'Post Type Singular Name', 'text_domain' ),<br>
        'menu_name'             => __( '" . $cpt_reg_name . "', 'text_domain' ),<br>
        'name_admin_bar'        => __( '" . $cpt_reg_name . "', 'text_domain' ),<br>
        'archives'              => __( '" . $cpt_archive_name . "', 'text_domain' ),<br>
        'parent_item_colon'     => __( 'Parent " . $cpt_custom_name . ":', 'text_domain' ),<br>
        'all_items'             => __( 'All " . $cpt_plural_name . "', 'text_domain' ),<br>
        'add_new_item'          => __( 'Add New " . $cpt_custom_name . "', 'text_domain' ),<br>
        'add_new'               => __( 'Add New " . $cpt_custom_name . "', 'text_domain' ),<br>
        'new_item'              => __( 'New " . $cpt_custom_name . "', 'text_domain' ),<br>
        'edit_item'             => __( 'Edit " . $cpt_custom_name . "', 'text_domain' ),<br>
        'update_item'           => __( 'Update " . $cpt_custom_name . "', 'text_domain' ),<br>
        'view_item'             => __( 'View " . $cpt_custom_name . "', 'text_domain' ),<br>
        'search_items'          => __( 'Search " . $cpt_plural_name . "', 'text_domain' ),<br>
        'not_found'             => __( '" . $cpt_custom_name . " Not found', 'text_domain' ),<br>
        'not_found_in_trash'    => __( '" . $cpt_custom_name . " Not found in Trash', 'text_domain' ),<br>
        'featured_image'        => __( 'Featured Image', 'text_domain' ),<br>
        'set_featured_image'    => __( 'Set featured image', 'text_domain' ),<br>
        'remove_featured_image' => __( 'Remove featured image', 'text_domain' ),<br>
        'use_featured_image'    => __( 'Use as featured image', 'text_domain' ),<br>
        'insert_into_item'      => __( 'Insert into " . $cpt_custom_name . "', 'text_domain' ),<br>
        'uploaded_to_this_item' => __( 'Uploaded to this " . $cpt_custom_name . "', 'text_domain' ),<br>
        'items_list'            => __( '" . $cpt_custom_name . " list', 'text_domain' ),<br>
        'items_list_navigation' => __( '" . $cpt_custom_name . " list navigation', 'text_domain' ),<br>
        'filter_items_list'     => __( 'Filter " . $cpt_custom_name . " list', 'text_domain' ),<br>
    );<br>
    $args = array(<br>
        'label'                 => __( '" . $cpt_reg_name . "', 'text_domain' ),<br>
        'description'           => __( '" . $cpt_desc . "', 'text_domain' ),<br>
        'labels'                => $labels,<br>
        'supports'              => array(" . $cpt_supports . "),<br>
        'taxonomies'            => array(" . $cpt_tax_array . "),<br>
        'hierarchical'          => false,<br>
        'public'                => true,<br>
        'show_ui'               => true,<br>
        'show_in_menu'          => true,<br>
        'menu_position'         => 5,<br>
        'show_in_admin_bar'     => true,<br>
        'show_in_nav_menus'     => true,<br>
        'can_export'            => true,<br>
        'has_archive'           => true,<br>        
        'exclude_from_search'   => false,<br>
        'publicly_queryable'    => true,<br>
        'capability_type'       => 'page',<br>
    );<br>
    register_post_type( 'ONE', $args );<br>
<br>
}<br>
add_action( 'init', '" . $cpt_func_name . "', 0 );";
}

// Create Form for User Input for Custom Post Type
function cpt_settings_page() { ?>
<div class="wrap">
<h2>Manage Your Custom Post Types</h2>


<!-- Admin Form -->
<form method="get" action="">
    <?php settings_fields( 'jh_cpt_settings_field' ); ?>
    <?php do_settings_sections( 'jh_cpt_settings_field' ); ?>
    <table class="form-table">        
        <tr valign="top">
        	<th scope="row">Custom Name</th>
	        <td>
	        	<input type="text" name="jh_cpt_function" value="<?php echo esc_attr( get_option('jh_cpt_function') ); ?>" />
	    	</td>
        </tr>
        <tr valign="top">
            <th scope="row">Post Type Description</th>
            <td>
                <input type="text" name="jh_cpt_description" value="<?php echo esc_attr( get_option('jh_cpt_description') ); ?>" />
            </td>
        </tr>
       <!--  <tr valign="top">
            <th scope="row">Name(singular)</th>
            <td>
                <input type="text" name="jh_cpt_name_single" value="<?php echo esc_attr( get_option('jh_cpt_name_single') ); ?>" />
            </td>
        </tr> -->
        <tr valign="top">
            <th scope="row">Link to Taxonomies</th>
            <td>
                <input type="text" name="jh_cpt_tax[]" value="<?php echo esc_attr( get_option('jh_cpt_tax') ); ?>" />
            </td>
        </tr>
        <tr valign="top">
            <th scope="row">Hierarchical</th>
            <td>
                <select name="jh_cpt_hierarchical" value="<?php echo esc_attr( get_option('jh_cpt_hierarchical') ); ?>" />
                    <option value="page">Like Page</option>
                    <option value="post">Like Post</option>
                </select>
            </td>
        </tr>
        <tr>
            <th scope="row">Post Type will Support</th>
            <td>
                <input type="checkbox" name="jh_cpt_supports[]" value="title">Title<br>
                <input type="checkbox" name="jh_cpt_supports[]" value="editor">Editor<br>
                <input type="checkbox" name="jh_cpt_supports[]" value="author">Author<br>
                <input type="checkbox" name="jh_cpt_supports[]" value="thumbnail">Featured Images<br>
                <input type="checkbox" name="jh_cpt_supports[]" value="excerpt">Excerpt<br>
                <input type="checkbox" name="jh_cpt_supports[]" value="trackbacks">Trackbacks<br>
                <input type="checkbox" name="jh_cpt_supports[]" value="custom-fields">Custom Fields<br>
                <input type="checkbox" name="jh_cpt_supports[]" value="comments">Comments<br>
                <input type="checkbox" name="jh_cpt_supports[]" value="revisions">Revisions<br>
                <input type="checkbox" name="jh_cpt_supports[]" value="page-attributes">Page Attributes<br>
                <input type="checkbox" name="jh_cpt_supports[]" value="post-formats">Post Formats<br>
            </td>
        </tr>
    </table>
    
    <?php submit_button(); ?>

</form>
</div>

<?php }

// add_action( 'admin_init', 'cpt_settings' );

// function cpt_settings() {
// 	register_setting( 'cpt_settings', 'post_type_name' );
// }

?>