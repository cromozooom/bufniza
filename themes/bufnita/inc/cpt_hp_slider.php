<?php

/* Slider */
function bufnita_post_type_slider() {
	$labels = array(
		'name'               => _x( 'Sliders', 'post type general name', 'your-plugin-textdomain' ),
		'singular_name'      => _x( 'Slider', 'post type singular name', 'your-plugin-textdomain' ),
		'menu_name'          => _x( 'Sliders', 'admin menu', 'your-plugin-textdomain' ),
		'name_admin_bar'     => _x( 'Slider', 'add new on admin bar', 'your-plugin-textdomain' ),
		'add_new'            => _x( 'Add New', 'slider', 'your-plugin-textdomain' ),
		'add_new_item'       => __( 'Add New Slider', 'your-plugin-textdomain' ),
		'new_item'           => __( 'New Slider', 'your-plugin-textdomain' ),
		'edit_item'          => __( 'Edit Slider', 'your-plugin-textdomain' ),
		'view_item'          => __( 'View Slider', 'your-plugin-textdomain' ),
		'all_items'          => __( 'All Sliders', 'your-plugin-textdomain' ),
		'search_items'       => __( 'Search Sliders', 'your-plugin-textdomain' ),
		'parent_item_colon'  => __( 'Parent Sliders:', 'your-plugin-textdomain' ),
		'not_found'          => __( 'No Sliders found.', 'your-plugin-textdomain' ),
		'not_found_in_trash' => __( 'No Sliders found in Trash.', 'your-plugin-textdomain' )
	);

	$args = array(
		'labels'             => $labels,
		'public'             => true,
		'publicly_queryable' => true,
		'show_ui'            => true,
		'show_in_menu'       => true,
		'query_var'          => true,
		'rewrite'            => array( 'slug' => 'sliders' ),
		'capability_type'    => 'post',
		'has_archive'        => true,
		'hierarchical'       => false,
		'menu_position'      => null,
		'supports'           => array( 'title', 'editor', 'thumbnail'),
		'register_meta_box_cb' => 'buf_add_attributes_metaboxes_slider',
	);

	register_post_type( 'slider', $args );
	
}
add_action('init', 'bufnita_post_type_slider');


//add_action( 'add_meta_boxes', 'buf_add_attributes_metaboxes_slider');
function buf_add_attributes_metaboxes_slider() {
	add_meta_box('buf_metabox_attributes', 'Slider link customization', 'buf_metabox_attributes_callback_slider', 'slider', 'normal', 'default');
}

function buf_metabox_attributes_callback_slider() {
	global $post;
	
	// Noncename needed to verify where the data originated
	echo '<input type="hidden" name="buf_slidermeta_noncename" id="buf_slidermeta_noncename" value="' . wp_create_nonce( plugin_basename(__FILE__) ) . '" />';
	$buf_slider_btn_label = get_post_meta($post->ID, 'buf_slider_btn_label', true);
	$buf_slider_link = get_post_meta($post->ID, 'buf_slider_link', true);
	?>
	
	<table class="form-table">
		<input type="hidden" name="buf_attrs_meta_noncename" id="buf_attrs_meta_noncename" value="' . wp_create_nonce( plugin_basename(__FILE__) ) . '" />
		<tr>
			<th><label>Link button label</label></th>
			<td>
				<input id="buf_slider_btn_label" type="text" value="<?=$buf_slider_btn_label?>" name="buf_slider_btn_label"/>
			</td>
		</tr>
		<tr>
			<th><label>Link</label></th>
			<td>
				<input id="buf_slider_link" type="text" value="<?=$buf_slider_link?>" name="buf_slider_link"/>		
			</td>
		</tr>
	</table> 
<?php
}

add_action( 'save_post', 'buf_save_post_slider_meta', 10, 2 );
function buf_save_post_slider_meta( $post_id ) {
	
    // Bail if we're doing an auto save
    if( defined( 'DOING_AUTOSAVE' ) && DOING_AUTOSAVE ) 
		return;
     
    // if our nonce isn't there, or we can't verify it, bail
    if( !isset( $_POST['buf_slidermeta_noncename'] ) || !wp_verify_nonce( $_POST['buf_slidermeta_noncename'], plugin_basename(__FILE__) ) ) 
		return;

	if( isset( $_POST['buf_slider_btn_label'] ) )
        update_post_meta( $post_id, 'buf_slider_btn_label', esc_attr( $_POST['buf_slider_btn_label'] ) );
	if( isset( $_POST['buf_slider_link'] ) )
        update_post_meta( $post_id, 'buf_slider_link', esc_attr( $_POST['buf_slider_link'] ) );
}