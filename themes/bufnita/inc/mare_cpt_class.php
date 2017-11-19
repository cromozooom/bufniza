<?php
class MareCpt {
	public $buf_mare_keys = array(
		'buf_mare_price_full',
		'buf_mare_price_discount',
		'buf_mare_price_visibility',
		'buf_mare_luni_check',
		'buf_mare_marti_check',
		'buf_mare_miercuri_check',
		'buf_mare_joi_check',
		'buf_mare_vineri_check',
		'buf_mare_sambata_check',
		'buf_mare_duminica_check',
		'buf_mare_first_interval_check',
		'buf_mare_second_interval_check',
		'buf_mare_third_interval_check',
		'buf_mare_fourth_interval_check',
		'buf_mare_short_period_desc',
		'buf_mare_long_period_desc',
		'buf_mare_teachers_assigned',
	);
    public function __construct() {
        add_action( 'add_meta_boxes', array( $this, 'add_meta_box' ) );
        add_action( 'save_post', array( $this, 'save' ) );
    }
 
    public function add_meta_box( $post_type ) {
        $post_types = array( 'course' );
        if ( in_array( $post_type, $post_types )) {
			add_meta_box(
				'buf_metabox_mari_attributes', // Unique ID
				'Mari', // Box title
				array( $this, 'render_form'), // Content callback
				'course', 
				'normal', 
				'default'
			);
        }
    }
 
    public function save( $post_id ) {
        // Bail if we're doing an auto save
		if( defined( 'DOING_AUTOSAVE' ) && DOING_AUTOSAVE ) 
			return;
		 
		// if our nonce isn't there, or we can't verify it, bail
		if( !isset( $_POST['buf_mare_attrs_meta_noncename'] ) || !wp_verify_nonce( $_POST['buf_mare_attrs_meta_noncename'], plugin_basename(__FILE__) ) ) 
			return;

		foreach($this->buf_mare_keys as $key) {
			if( isset($_POST[$key]) ){
				$value = is_array($_POST[$key]) ? serialize($_POST[$key]) : $_POST[$key];
				update_post_meta($post_id, $key, $value );
			} else {
				delete_post_meta($post_id, $key);
			}
		}

		//echo '<pre>';print_R($cpt_info);die;
    }
 
    public function render_form( $post ) {
        $buf_mare_price_full = get_post_meta($post->ID, 'buf_mare_price_full', true);
		$buf_mare_price_discount = get_post_meta($post->ID, 'buf_mare_price_discount', true);
		$buf_mare_price_visibility = get_post_meta($post->ID, 'buf_mare_price_visibility', true);		
		
		$buf_mare_luni_check = get_post_meta($post->ID, 'buf_mare_luni_check', true);
		$buf_mare_marti_check = get_post_meta($post->ID, 'buf_mare_marti_check', true);
		$buf_mare_miercuri_check = get_post_meta($post->ID, 'buf_mare_miercuri_check', true);
		$buf_mare_joi_check = get_post_meta($post->ID, 'buf_mare_joi_check', true);
		$buf_mare_vineri_check = get_post_meta($post->ID, 'buf_mare_vineri_check', true);
		$buf_mare_sambata_check = get_post_meta($post->ID, 'buf_mare_sambata_check', true);
		$buf_mare_duminica_check = get_post_meta($post->ID, 'buf_mare_duminica_check', true);
		
		$buf_mare_first_interval_check = get_post_meta($post->ID, 'buf_mare_first_interval_check', true);
		$buf_mare_second_interval_check = get_post_meta($post->ID, 'buf_mare_second_interval_check', true);
		$buf_mare_third_interval_check = get_post_meta($post->ID, 'buf_mare_third_interval_check', true);
		$buf_mare_fourth_interval_check = get_post_meta($post->ID, 'buf_mare_fourth_interval_check', true);
		
		$buf_mare_short_period_desc = get_post_meta($post->ID, 'buf_mare_short_period_desc', true);
		$buf_mare_long_period_desc = get_post_meta($post->ID, 'buf_mare_long_period_desc', true);
		
		$selected_values = unserialize(get_post_meta($post->ID, 'buf_mare_teachers_assigned', true));
		?>
		
		<table class="form-table">
			<input type="hidden" name="buf_mare_attrs_meta_noncename" id="buf_mare_attrs_meta_noncename" value="<?=wp_create_nonce( plugin_basename(__FILE__) ) ?>" />
			<tr>
				<th><label>Pret intreg</label></th>
				<td>
					<input type="text" value="<?=get_post_meta($post->ID, 'buf_mare_price_full', true)?>" name="buf_mare_price_full"/>
				</td>
				<th><label>Pret cu discount</label></th>
				<td>
					<input type="text" value="<?=get_post_meta($post->ID, 'buf_mare_price_discount', true)?>" name="buf_mare_price_discount"/>
				</td>
				<th><label>Afiseaza pret</label></th>
				<td>
					<input type="checkbox" id="buf_mare_price_visibility" name="buf_mare_price_visibility" <?php checked( $buf_mare_price_visibility, 'on' ); ?> />
				</td>
			</tr>
		</table>
		<table class="form-table">
			<tr>
				<th><label>Timeframe</label></th>
			</tr>
			<tr>
				<td><label>Luni</label></td>
				<td><label>Marti</label></td>
				<td><label>Miercuri</label></td>
				<td><label>Joi</label></td>
				<td><label>Vineri</label></td>
				<td><label>Sambata</label></td>
				<td><label>Duminica</label></td>
			</tr>
			<tr>
				<td>
					 <input type="checkbox" id="buf_mare_luni_check" name="buf_mare_luni_check" <?php checked( $buf_mare_luni_check, 'on' ); ?> />
				</td>
				<td>
					 <input type="checkbox" id="buf_mare_marti_check" name="buf_mare_marti_check" <?php checked( $buf_mare_marti_check, 'on' ); ?> />
				</td>
				<td>
					 <input type="checkbox" id="buf_mare_miercuri_check" name="buf_mare_miercuri_check" <?php checked( $buf_mare_miercuri_check, 'on' ); ?> />
				</td>
				<td>
					 <input type="checkbox" id="buf_mare_joi_check" name="buf_mare_joi_check" <?php checked( $buf_mare_joi_check, 'on' ); ?> />
				</td>
				<td>
					 <input type="checkbox" id="buf_mare_vineri_check" name="buf_mare_vineri_check" <?php checked( $buf_mare_vineri_check, 'on' ); ?> />
				</td>
				<td>
					 <input type="checkbox" id="buf_mare_sambata_check" name="buf_mare_sambata_check" <?php checked( $buf_mare_sambata_check, 'on' ); ?> />
				</td>
				<td>
					 <input type="checkbox" id="buf_mare_duminica_check" name="buf_mare_duminica_check" <?php checked( $buf_mare_duminica_check, 'on' ); ?> />
				</td>
			</tr>
		</table>
		<table class="form-table">
			<tr>
				<td><label>7.00 - 10.00</label></td>
				<td><label>10.00 - 13.00</label></td>
				<td><label>13.00 - 16.00</label></td>
				<td><label>16.00 - 19.00</label></td>
			</tr>
			<tr>
				<td>
					 <input type="checkbox" id="buf_mare_first_interval_check" name="buf_mare_first_interval_check" <?php checked( $buf_mare_first_interval_check, 'on' ); ?> />
				</td>
				<td>
					 <input type="checkbox" id="buf_mare_second_interval_check" name="buf_mare_second_interval_check" <?php checked( $buf_mare_second_interval_check, 'on' ); ?> />
				</td>
				<td>
					 <input type="checkbox" id="buf_mare_third_interval_check" name="buf_mare_third_interval_check" <?php checked( $buf_mare_third_interval_check, 'on' ); ?> />
				</td>
				<td>
					 <input type="checkbox" id="buf_mare_fourth_interval_check" name="buf_mare_fourth_interval_check" <?php checked( $buf_mare_fourth_interval_check, 'on' ); ?> />
				</td>
			</tr>
		</table>
		<table class="form-table">
			<tr>
				<th colspan="2"><label>Perioada de timp</label></th>
			</tr>
			<tr>
				<th>Scurta descriere</th>
				<td><input style="width:520px;" type="text" value="<?=$buf_mare_short_period_desc?>" name="buf_mare_short_period_desc"/></td>
			</tr>
			<tr>
				<th>Sapou</th>
				<td><textarea cols="70" rows="6" name="buf_mare_long_period_desc"><?=$buf_mare_long_period_desc?></textarea></td>
			</tr>
		</table>
		<table class="form-table">
			<tr>
				<th><label>Asociaza profesor</label></th>
				<td>
					<select style="width:200px;" name="buf_mare_teachers_assigned[]" multiple="multiple">
					<?php foreach(getTeachersList() as $teacher_id => $teacher_name) : ?>
						<?php $sel_val = in_array($teacher_id, $selected_values) ? 'selected="selected"' : false;?>
						<option value="<?=$teacher_id?>" <?=$sel_val?>><?=$teacher_name?></option>				
					<?php endforeach;?>
				</td>
			</tr>
		</table>
		<?php
    }
}
