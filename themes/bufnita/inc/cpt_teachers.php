<?php

/* Teacher */
function bufnita_post_type_teacher() {
	$labels = array(
		'name'               => _x( 'Teachers', 'post type general name', 'your-plugin-textdomain' ),
		'singular_name'      => _x( 'Teacher', 'post type singular name', 'your-plugin-textdomain' ),
		'menu_name'          => _x( 'Teachers', 'admin menu', 'your-plugin-textdomain' ),
		'name_admin_bar'     => _x( 'Teacher', 'add new on admin bar', 'your-plugin-textdomain' ),
		'add_new'            => _x( 'Add New', 'teacher', 'your-plugin-textdomain' ),
		'add_new_item'       => __( 'Add New Teacher', 'your-plugin-textdomain' ),
		'new_item'           => __( 'New Teacher', 'your-plugin-textdomain' ),
		'edit_item'          => __( 'Edit Teacher', 'your-plugin-textdomain' ),
		'view_item'          => __( 'View Teacher', 'your-plugin-textdomain' ),
		'all_items'          => __( 'All Teachers', 'your-plugin-textdomain' ),
		'search_items'       => __( 'Search Teachers', 'your-plugin-textdomain' ),
		'parent_item_colon'  => __( 'Parent Teachers:', 'your-plugin-textdomain' ),
		'not_found'          => __( 'No Teachers found.', 'your-plugin-textdomain' ),
		'not_found_in_trash' => __( 'No Teachers found in Trash.', 'your-plugin-textdomain' )
	);

	$args = array(
		'labels'             => $labels,
		'public'             => true,
		'publicly_queryable' => true,
		'show_ui'            => true,
		'show_in_menu'       => true,
		'query_var'          => true,
		'rewrite'            => array( 'slug' => 'teachers' ),
		'capability_type'    => 'post',
		'has_archive'        => true,
		'hierarchical'       => false,
		'menu_position'      => null,
		'supports'           => array( 'title', 'editor', 'thumbnail', 'excerpt'),
		'register_meta_box_cb' => 'buf_add_attributes_metaboxes_teacher',
	);

	register_post_type( 'teacher', $args );
	
}
add_action('init', 'bufnita_post_type_teacher');


//add_action( 'add_meta_boxes', 'buf_add_attributes_metaboxes_teacher');
function buf_add_attributes_metaboxes_teacher() {
	add_meta_box('buf_metabox_attributes', 'Extra Settings', 'buf_metabox_attributes_callback_teacher', 'teacher', 'normal', 'default');
}

function buf_metabox_attributes_callback_teacher() {
	global $post;
	
	// Noncename needed to verify where the data originated
	echo '<input type="hidden" name="buf_teachermeta_noncename" id="buf_teachermeta_noncename" value="' . wp_create_nonce( plugin_basename(__FILE__) ) . '" />';
	$selected_article_id = get_post_meta($post->ID, 'buf_teacher_art_id', true);
	$buf_teacher_functie = get_post_meta($post->ID, 'buf_teacher_functie', true);
	$buf_teacher_show_on_hp = get_post_meta($post->ID, 'buf_teacher_show_on_hp', true);
	?>
	
	<table class="form-table">
		<input type="hidden" name="buf_attrs_meta_noncename" id="buf_attrs_meta_noncename" value="' . wp_create_nonce( plugin_basename(__FILE__) ) . '" />
		<tr>
			<th><label>Articol de prezentare</label></th>
			<td>
				<select name="buf_teacher_art_id" id="buf_teacher_art_id" style="width: 300px;">
					<option value="">Presentation article</option>
				<?php foreach ( getPresentationTeachersArticle() as $id => $art_title) :?>
					<option value="<?=$id?>" <?php selected( $selected_article_id, $id ); ?>><?=$art_title?></option>
				<?php endforeach;?>
				</select>
			</td>
		</tr>
		<tr>
			<th><label>Role</label></th>
			<td>
				<input id="buf_teacher_functie" type="text" value="<?=$buf_teacher_functie?>" name="buf_teacher_functie"/>		
			</td>
		</tr>
		<tr>
			<th><label>Show on homepage</label></th>
			<td>
				<input type="checkbox" id="buf_teacher_show_on_hp" name="buf_teacher_show_on_hp" <?php checked( $buf_teacher_show_on_hp, 'on' ); ?> />
			</td>
		</tr>
	</table> 
<?php
}

add_action( 'save_post', 'buf_save_post_teacher_meta', 10, 2 );

$teachers_keys_cpm = array(
	'buf_teacher_art_id',
	'buf_teacher_functie',
	'buf_teacher_show_on_hp',
);
function buf_save_post_teacher_meta( $post_id ) {
	global $teachers_keys_cpm;
	
    // Bail if we're doing an auto save
    if( defined( 'DOING_AUTOSAVE' ) && DOING_AUTOSAVE ) 
		return;
     
    // if our nonce isn't there, or we can't verify it, bail
    if( !isset( $_POST['buf_teachermeta_noncename'] ) || !wp_verify_nonce( $_POST['buf_teachermeta_noncename'], plugin_basename(__FILE__) ) ) 
		return;

	foreach($teachers_keys_cpm as $key) {
		if( isset($_POST[$key]) ){
			$value = is_array($_POST[$key]) ? serialize($_POST[$key]) : $_POST[$key];
			update_post_meta($post_id, $key, $value );
		} else {
			delete_post_meta($post_id, $key);
		}
	}
}

function buf_manage_teacher_columns( $columns ) {
	$new_columns = array(
		'buf_teacher_art_id' => 'Presentation article',
		'buf_teacher_functie' => 'Functie'
	);	
    return array_merge($columns, $new_columns);
}
add_filter( 'manage_edit-teacher_columns', 'buf_manage_teacher_columns', 10, 1);



function buf_manage_teacher_custom_column( $column, $post_id ) {
    switch ($column) {
        case 'buf_teacher_art_id':
			$post = get_post( get_post_meta($post_id, 'buf_teacher_art_id', true));
            echo $post ? $post->post_title : '-';
			break;
		case 'buf_teacher_functie':
			$val = get_post_meta($post_id, 'buf_teacher_functie', true);
			echo $val;
			break;
    }
}

add_action( 'manage_teacher_posts_custom_column', 'buf_manage_teacher_custom_column', 10, 2 );