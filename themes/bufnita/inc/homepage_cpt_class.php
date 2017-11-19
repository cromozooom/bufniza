<?php
class HomepageCpt {
	public $buf_show_on_hp_keys = array(
		'buf_show_on_hp_check',
		'buf_show_on_hp_svg_id'
	);
    public function __construct() {
        add_action( 'add_meta_boxes', array( $this, 'add_meta_box' ) );
        add_action( 'save_post', array( $this, 'save' ) );
    }
 
    public function add_meta_box( $post_type ) {
        $post_types = array( 'course' );
        if ( in_array( $post_type, $post_types )) {
			add_meta_box(
				'buf_metabox_show_on_hp_attributes', // Unique ID
				'Show on Homepage', // Box title
				array( $this, 'render_form'), // Content callback
				'course', 
				'side', 
				'default'
			);
        }
    }
 
    public function save( $post_id ) {
        // Bail if we're doing an auto save
		if( defined( 'DOING_AUTOSAVE' ) && DOING_AUTOSAVE ) 
			return;
		 
		// if our nonce isn't there, or we can't verify it, bail
		if( !isset( $_POST['buf_show_on_hp_attrs_meta_noncename'] ) || !wp_verify_nonce( $_POST['buf_show_on_hp_attrs_meta_noncename'], plugin_basename(__FILE__) ) ) 
			return;
	//echo '<pre>';print_R($_POST);die;
		foreach($this->buf_show_on_hp_keys as $key) {
			if( isset($_POST[$key]) ){
				update_post_meta($post_id, $key, $_POST[$key] );
			} else {
				delete_post_meta($post_id, $key); 
			}
		}
    }
 
    public function render_form( $post ) {
		global $svg_courses_assoc_config;
        $buf_show_on_hp_check = get_post_meta($post->ID, 'buf_show_on_hp_check', true);
		$buf_show_on_hp_svg_id = get_post_meta($post->ID, 'buf_show_on_hp_svg_id', true);?>
		
		<table class="form-table">
			<input type="hidden" name="buf_show_on_hp_attrs_meta_noncename" id="buf_show_on_hp_attrs_meta_noncename" value="<?=wp_create_nonce( plugin_basename(__FILE__) ) ?>" />
			<tr>
				<th style="width:50px;"><label>Show</label></th>
				<td>
					<input type="checkbox" id="buf_show_on_hp_check" name="buf_show_on_hp_check" <?php checked( $buf_show_on_hp_check, 'on' ); ?> />
				</td>
			</tr>
		</table>
		<table class="form-table">
			<tr>
				<td style="padding-left:0">
					<select name="buf_show_on_hp_svg_id" id="buf_show_on_hp_svg_id" name="buf_show_on_hp_svg_id">
					<?php foreach ( $svg_courses_assoc_config as $svg_tag_id => $icon_title) :?>
						<option value="<?=$svg_tag_id?>" <?php selected( $buf_show_on_hp_svg_id, $svg_tag_id ); ?>><?=$icon_title?></option>
					<?php endforeach;?>
					</select>
				</td>
			</tr>
		</table>
		<?php
    }
}
