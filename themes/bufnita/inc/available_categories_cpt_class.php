<?php
class AvailableCategoriesCpt {
	public $buf_available_categories_keys = array(
		'buf_mic_categ_available',
		'buf_mijlociu_categ_available',
		'buf_mare_categ_available',
	);
    public function __construct() {
        add_action( 'add_meta_boxes', array( $this, 'add_meta_box' ) );
        add_action( 'save_post', array( $this, 'save' ) );
    }
 
    public function add_meta_box( $post_type ) {
        $post_types = array( 'course' );
        if ( in_array( $post_type, $post_types )) {
			add_meta_box(
				'buf_metabox_available_categories_attributes', // Unique ID
				'Categorii disponibile', // Box title
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
		if( !isset( $_POST['buf_available_categories_attrs_meta_noncename'] ) || !wp_verify_nonce( $_POST['buf_available_categories_attrs_meta_noncename'], plugin_basename(__FILE__) ) ) 
			return;
		//echo '<pre>';print_R($_POST);die;
		foreach($this->buf_available_categories_keys as $key) {
			if( isset($_POST[$key]) ){
				update_post_meta($post_id, $key, $_POST[$key] );
			} else {
				delete_post_meta($post_id, $key); 
			}
		}
    }
 
    public function render_form( $post ) {
        $buf_mic_categ_available = get_post_meta($post->ID, 'buf_mic_categ_available', true);
		$buf_mijlociu_categ_available = get_post_meta($post->ID, 'buf_mijlociu_categ_available', true);
		$buf_mare_categ_available = get_post_meta($post->ID, 'buf_mare_categ_available', true);?>
		
		<table class="form-table">
			<input type="hidden" name="buf_available_categories_attrs_meta_noncename" id="buf_available_categories_attrs_meta_noncename" value="<?=wp_create_nonce( plugin_basename(__FILE__) ) ?>" />
			<tr>
				<th style="width:100px;"><label>Grupa mica</label></th>
				<td>
					<input type="checkbox" id="buf_mic_categ_available" name="buf_mic_categ_available" <?php checked( $buf_mic_categ_available, 'on' ); ?> />
				</td>
			</tr>
			<tr>
				<th style="width:100px;"><label>Grupa mijlocie</label></th>
				<td>
					<input type="checkbox" id="buf_mijlociu_categ_available" name="buf_mijlociu_categ_available" <?php checked( $buf_mijlociu_categ_available, 'on' ); ?> />
				</td>
			</tr>
			<tr>
				<th style="width:100px;"><label>Grupa mare</label></th>
				<td>
					<input type="checkbox" id="buf_mare_categ_available" name="buf_mare_categ_available" <?php checked( $buf_mare_categ_available, 'on' ); ?> />
				</td>
			</tr>
		</table>
		<?php
    }
}
