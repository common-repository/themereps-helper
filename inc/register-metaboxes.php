<?php

add_action("admin_init", "themereps_helper_metabox_init");
function themereps_helper_metabox_init(){

    add_meta_box( 'project_client_name',  esc_html__( 'Client Name', 'themereps-helper' ), 'themereps_project_client', 'trh_portfolio', 'side', 'high',  array( '__back_compat_meta_box' => false, ) );

    add_meta_box( 'project_location',  esc_html__( 'Location', 'themereps-helper' ), 'themereps_project_location', 'trh_portfolio', 'side', 'high',  array( '__back_compat_meta_box' => false, ) );

    add_meta_box( 'project_start_date',  esc_html__( 'Starting Date', 'themereps-helper' ), 'themereps_project_start_date', 'trh_portfolio', 'side', 'high',  array( '__back_compat_meta_box' => false, ) );

    add_meta_box( 'project_close_date',  esc_html__( 'Closing Date', 'themereps-helper' ), 'themereps_project_close_date', 'trh_portfolio', 'side', 'high',  array( '__back_compat_meta_box' => false, ) );

    add_meta_box( 'project_budget',  esc_html__( 'Budget', 'themereps-helper' ), 'themereps_project_budget', 'trh_portfolio', 'side', 'high',  array( '__back_compat_meta_box' => false, ) );

}

// Position metabox
function themereps_project_client() {
    global $post;
    $custom_meta = get_post_custom(get_the_ID());
    if (!empty($custom_meta)){
        if(isset($custom_meta['themereps_project_client'])){
            $select_position = $custom_meta['themereps_project_client'][0];
        }
    }
    ?>
    <fieldset class="fieldset related_pages">
        <div class = "themerepshelper_metabox">
            <input type="text" name="themereps_project_client" value="<?php if(isset($select_position)) echo $select_position;?>"  style="width: 100%;">
        </div>
    </fieldset>
    <?php
}

// Position metabox
function themereps_project_location() {
    global $post;
    $custom_meta = get_post_custom(get_the_ID());
    if (!empty($custom_meta)){
        if(isset($custom_meta['themereps_project_location'])){
            $select_position = $custom_meta['themereps_project_location'][0];
        }
    }
    ?>
    <fieldset class="fieldset related_pages">
        <div class = "themerepshelper_metabox">
            <input type="text" name="themereps_project_location" value="<?php if(isset($select_position)) echo $select_position;?>"  style="width: 100%;">
        </div>
    </fieldset>
    <?php
}


// Position metabox
function themereps_project_start_date() {
    global $post;
    $custom_meta = get_post_custom(get_the_ID());
    if (!empty($custom_meta)){
        if(isset($custom_meta['themereps_project_start_date'])){
            $select_position = $custom_meta['themereps_project_start_date'][0];
        }
    }
    ?>
    <fieldset class="fieldset related_pages">
        <div class = "themerepshelper_metabox">
            <input type="text" name="themereps_project_start_date" value="<?php if(isset($select_position)) echo $select_position;?>"  style="width: 100%;">
        </div>
    </fieldset>
    <?php
}


// Position metabox
function themereps_project_close_date() {
    global $post;
    $custom_meta = get_post_custom(get_the_ID());
    if (!empty($custom_meta)){
        if(isset($custom_meta['themereps_project_close_date'])){
            $select_position = $custom_meta['themereps_project_close_date'][0];
        }
    }
    ?>
    <fieldset class="fieldset related_pages">
        <div class = "themerepshelper_metabox">
            <input type="text" name="themereps_project_close_date" value="<?php if(isset($select_position)) echo $select_position;?>"  style="width: 100%;">
        </div>
    </fieldset>
    <?php
}


// Position metabox
function themereps_project_budget() {
    global $post;
    $custom_meta = get_post_custom(get_the_ID());
    if (!empty($custom_meta)){
        if(isset($custom_meta['themereps_project_budget'])){
            $select_position = $custom_meta['themereps_project_budget'][0];
        }
    }
    ?>
    <fieldset class="fieldset related_pages">
        <div class = "themerepshelper_metabox">
            <input type="text" name="themereps_project_budget" value="<?php if(isset($select_position)) echo $select_position;?>"  style="width: 100%;">
        </div>
    </fieldset>
    <?php
}

function themereps_helper_metabox_fields() {
    global $post;

    if(isset($_POST["themereps_project_client"])) {
        update_post_meta($post->ID, "themereps_project_client", sanitize_text_field($_POST["themereps_project_client"]) );
    }


    if(isset($_POST["themereps_project_location"])) {
        update_post_meta($post->ID, "themereps_project_location", sanitize_text_field($_POST["themereps_project_location"]) );
    }


    if(isset($_POST["themereps_project_start_date"])) {
        update_post_meta($post->ID, "themereps_project_start_date", sanitize_text_field($_POST["themereps_project_start_date"]) );
    }

    if(isset($_POST["themereps_project_close_date"])) {
        update_post_meta($post->ID, "themereps_project_close_date", sanitize_text_field($_POST["themereps_project_close_date"]) );
    }

    if(isset($_POST["themereps_project_budget"])) {
        update_post_meta($post->ID, "themereps_project_budget", sanitize_text_field($_POST["themereps_project_budget"]) );
    }

}
add_action('save_post', 'themereps_helper_metabox_fields');






// Meta Box Class: PlanInfoMetaBox
// Get the field value: $metavalue = get_post_meta( $post_id, $field_id, true );
class PlanInfoMetaBox {
	private $config = '{"title":"Plan Information","prefix":"plan_","domain":"themereps-helper","class_name":"PlanInfoMetaBox","context":"normal","priority":"default","cpt":"trh_pricing","fields":[{"type":"text","label":"Price","default":"99","id":"plan_price"},{"type":"text","label":"Duration Text","default":"Month","id":"plan_duration"},{"type":"text","label":"Currency Symbol","default":"$","id":"plan_currency"},{"type":"text","label":"Button Text","default":"Purchase Now","id":"plan_btn_text"},{"type":"url","label":"Button Url","default":"#","id":"plan_btn_url"},{"type":"checkbox","label":"Button open new window?","checked":"1","id":"plan_btn_target"},{"type":"checkbox","label":"Active Plan?","id":"plan_active"}]}';

	public function __construct() {
		$this->config = json_decode( $this->config, true );
		$this->process_cpts();
		add_action( 'add_meta_boxes', [ $this, 'add_meta_boxes' ] );
		add_action( 'admin_head', [ $this, 'admin_head' ] );
		add_action( 'save_post', [ $this, 'save_post' ] );
	}

	public function process_cpts() {
		if ( !empty( $this->config['cpt'] ) ) {
			if ( empty( $this->config['post-type'] ) ) {
				$this->config['post-type'] = [];
			}
			$parts = explode( ',', $this->config['cpt'] );
			$parts = array_map( 'trim', $parts );
			$this->config['post-type'] = array_merge( $this->config['post-type'], $parts );
		}
	}

	public function add_meta_boxes() {
		foreach ( $this->config['post-type'] as $screen ) {
			add_meta_box(
				sanitize_title( $this->config['title'] ),
				$this->config['title'],
				[ $this, 'add_meta_box_callback' ],
				$screen,
				$this->config['context'],
				$this->config['priority']
			);
		}
	}

	public function admin_head() {
		global $typenow;
		if ( in_array( $typenow, $this->config['post-type'] ) ) {
			?><?php
		}
	}

	public function save_post( $post_id ) {
		foreach ( $this->config['fields'] as $field ) {
			switch ( $field['type'] ) {
				case 'checkbox':
					update_post_meta( $post_id, $field['id'], isset( $_POST[ $field['id'] ] ) ? $_POST[ $field['id'] ] : '' );
					break;
				case 'url':
					if ( isset( $_POST[ $field['id'] ] ) ) {
						$sanitized = esc_url_raw( $_POST[ $field['id'] ] );
						update_post_meta( $post_id, $field['id'], $sanitized );
					}
					break;
				default:
					if ( isset( $_POST[ $field['id'] ] ) ) {
						$sanitized = sanitize_text_field( $_POST[ $field['id'] ] );
						update_post_meta( $post_id, $field['id'], $sanitized );
					}
			}
		}
	}

	public function add_meta_box_callback() {
		$this->fields_table();
	}

	private function fields_table() {
		?><table class="form-table" role="presentation">
			<tbody><?php
				foreach ( $this->config['fields'] as $field ) {
					?><tr>
						<th scope="row"><?php $this->label( $field ); ?></th>
						<td><?php $this->field( $field ); ?></td>
					</tr><?php
				}
			?></tbody>
		</table><?php
	}

	private function label( $field ) {
		switch ( $field['type'] ) {
			default:
				printf(
					'<label class="" for="%s">%s</label>',
					$field['id'], $field['label']
				);
		}
	}

	private function field( $field ) {
		switch ( $field['type'] ) {
			case 'checkbox':
				$this->checkbox( $field );
				break;
			default:
				$this->input( $field );
		}
	}

	private function checkbox( $field ) {
		printf(
			'<label class="rwp-checkbox-label"><input %s id="%s" name="%s" type="checkbox"> %s</label>',
			$this->checked( $field ),
			$field['id'], $field['id'],
			isset( $field['description'] ) ? $field['description'] : ''
		);
	}

	private function input( $field ) {
		printf(
			'<input class="regular-text %s" id="%s" name="%s" %s type="%s" value="%s">',
			isset( $field['class'] ) ? $field['class'] : '',
			$field['id'], $field['id'],
			isset( $field['pattern'] ) ? "pattern='{$field['pattern']}'" : '',
			$field['type'],
			$this->value( $field )
		);
	}

	private function value( $field ) {
		global $post;
		if ( metadata_exists( 'post', $post->ID, $field['id'] ) ) {
			$value = get_post_meta( $post->ID, $field['id'], true );
		} else if ( isset( $field['default'] ) ) {
			$value = $field['default'];
		} else {
			return '';
		}
		return str_replace( '\u0027', "'", $value );
	}

	private function checked( $field ) {
		global $post;
		if ( metadata_exists( 'post', $post->ID, $field['id'] ) ) {
			$value = get_post_meta( $post->ID, $field['id'], true );
			if ( $value === 'on' ) {
				return 'checked';
			}
			return '';
		} else if ( isset( $field['checked'] ) ) {
			return 'checked';
		}
		return '';
	}
}
new PlanInfoMetaBox;


















