<?php
if ( ! defined( 'ABSPATH' ) ) {
	die( 'You are not allowed to call this page directly.' );
}
?>
<div class="form_results<?php echo esc_attr( $atts['style'] ? FrmFormsHelper::get_form_style_class( $atts['form'] ) : '' ); ?>" id="form_results<?php echo (int) $atts['form']->id ?>">
<div id="frm_google_table_<?php echo (int) $atts['form']->id ?>"></div></div>
