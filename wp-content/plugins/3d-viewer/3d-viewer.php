<?php 
/*
 * Plugin Name: 3D Viewer
 * Plugin URI:  https://bplugins.com/
 * Description: Easily display interactive 3D models on the web. Supported File type .glb, .gltf
 * Version: 1.1.0
 * Author: bPlugins LLC
 * Author URI: http://bplugins.com
 * License: GPLv3
 * Text Domain:  model-viewer
 * Domain Path:  /languages
*/


// load text domain
function bp3dviewer_load_textdomain() {
    load_plugin_textdomain( 'model-viewer', false, dirname( __FILE__ ) . "/languages" );
}

add_action( "plugins_loaded", 'bp3dviewer_load_textdomain' );

/*Some Set-up*/
define('BP3DVIEWER_PLUGIN_DIR', WP_PLUGIN_URL . '/' . plugin_basename( dirname(__FILE__) ) . '/' );
define('BP3DVIEWER_PLUGIN_VERSION','1.1.0' );
 


//Lets register our shortcode
function bp3dviewer_cpt_content_func( $atts ){
	extract( shortcode_atts( array(

		'id' => '',

	), $atts ) ); ob_start(); ?>	
 
<?php 


// Options Data

$modeview_3d = get_post_meta( $id, '_bp3dimages_', true );

$model_src  = null;
$model_width = null;
$model_height = null;

if( is_array($modeview_3d['bp_3d_src']) && !empty($modeview_3d['bp_3d_src']['url'] )){
    $model_src   = $modeview_3d['bp_3d_src']['url'];
}
if( is_array($modeview_3d['bp_3d_width']) && !empty($modeview_3d['bp_3d_width']['width'] )){
    $model_width  = $modeview_3d['bp_3d_width']['width'].$modeview_3d['bp_3d_width']['unit'];
}
if( is_array($modeview_3d['bp_3d_height']) && !empty($modeview_3d['bp_3d_height']['height'] )){
    $model_height  = $modeview_3d['bp_3d_height']['height'].$modeview_3d['bp_3d_height']['unit'];
}

$camera_control  = $modeview_3d['bp_camera_control'] == 1 ? 'camera-controls' : '';
$alt             = !empty($modeview_3d['bp_3d_src']['url']) ? $modeview_3d['bp_3d_src']['title'] : '';
$auto_rotate     = $modeview_3d['bp_3d_rotate'] == 1 ? 'auto-rotate' : '';
$zooming_3d      = $modeview_3d['bp_3d_zooming'] == 1 ? 'disable-zoom' : 'kisoakta';
$loading_type    = $modeview_3d['bp_3d_loading'] ? $modeview_3d['bp_3d_loading'] : null;

?>


<model-viewer class="model" src="<?php echo esc_url($model_src); ?>" alt="<?php echo esc_attr($alt); ?>" <?php echo esc_attr($camera_control); ?> <?php echo esc_attr($zooming_3d); ?> loading="<?php  echo esc_attr($loading_type); ?>" <?php echo esc_attr($auto_rotate); ?> >
</model-viewer>

<style>
.model {
    width: <?php echo esc_attr($model_width); ?>;
    height:<?php echo esc_attr($model_height); ?>;
}
</style>


<?php  
// Scripts
echo wp_get_script_tag(
    array(
        'src'      =>BP3DVIEWER_PLUGIN_DIR.'public/js/model-viewer.min.js',
        'type' => 'module',
    )
); 

$output = ob_get_clean(); return $output; 

}
add_shortcode('3d_viewer','bp3dviewer_cpt_content_func');


// Custom post-type
function bp_3d_viewer(){
    $labels = array(
        'name'                  => __( '3D Viewer', 'model-viewer' ),
        'menu_name'             => __( '3D Viewer', 'model-viewer' ),
        'name_admin_bar'        => __( '3D Viewer', 'model-viewer' ),
        'add_new'               => __( 'Add New', 'model-viewer' ),
        'add_new_item'          => __( 'Add New ', 'model-viewer' ),
        'new_item'              => __( 'New 3D Viewer ', 'model-viewer' ),
        'edit_item'             => __( 'Edit 3D Viewer ', 'model-viewer' ),
        'view_item'             => __( 'View 3D Viewer ', 'model-viewer' ),
        'all_items'             => __( 'All 3D Viewer', 'model-viewer' ),
        'not_found'             => __( 'Sorry, we couldn\'t find the Feed you are looking for.' )
    ); 
    $args = array(
        'labels'             => $labels,
        'description'        => __('3D Viewer Options.', 'model-viewer'),
        'public'             => false,
        'show_ui'            => true,
        'show_in_menu'       => true,
        'menu_icon'          => 'dashicons-format-image',
        'query_var'          => true,
        'rewrite'            => array( 'slug' => 'model-viewer' ),
        'capability_type'    => 'post',
        'has_archive'        => false,
        'hierarchical'       => false,
        'menu_position'      => 20,
        'supports'           => array( 'title'),
    );
    register_post_type( 'bp3d-model-viewer', $args );
}
add_action( 'init', 'bp_3d_viewer');


// Additional admin style
function bp3d_admin_style(){
    wp_register_style( 'bp3d-custom-style', plugin_dir_url( __FILE__ ). 'public/css/custom-style.css');
    wp_enqueue_style('bp3d-custom-style');
}
add_action('admin_enqueue_scripts', 'bp3d_admin_style');


// External files Inclusion
require_once 'inc/csf/csf-config.php';
require_once 'inc/csf/metabox-options.php';

// Mimes
require_once 'inc/mimes/enable-mime-type.php';



//
/*-------------------------------------------------------------------------------*/
/*   Additional Features
/*-------------------------------------------------------------------------------*/

// Hide & Disabled View, Quick Edit and Preview Button 
function bppiv_remove_row_actions( $idtions ) {
	global $post;
    if( $post->post_type == 'bp3d-model-viewer' ) {
		unset( $idtions['view'] );
		unset( $idtions['inline hide-if-no-js'] );
	}
    return $idtions;
}

if ( is_admin() ) {
add_filter( 'post_row_actions','bppiv_remove_row_actions', 10, 2 );}

// HIDE everything in PUBLISH metabox except Move to Trash & PUBLISH button
function bppiv_hide_publishing_actions(){
    $my_post_type = 'bp3d-model-viewer';
    global $post;
    if($post->post_type == $my_post_type){
        echo '
            <style type="text/css">
                #misc-publishing-actions,
                #minor-publishing-actions{
                    display:none;
                }
            </style>
        ';
    }
}
add_action('admin_head-post.php', 'bppiv_hide_publishing_actions');
add_action('admin_head-post-new.php', 'bppiv_hide_publishing_actions');	

/*-------------------------------------------------------------------------------*/
// Remove post update massage and link 
/*-------------------------------------------------------------------------------*/

function bppiv_updated_messages( $messages ) {
    $messages['bp3d-model-viewer'][1] = __('Shortcode updated ', 'model-viewer');
    return $messages;
}
add_filter('post_updated_messages','bppiv_updated_messages');

/*-------------------------------------------------------------------------------*/
/* Change publish button to save.
/*-------------------------------------------------------------------------------*/
add_filter( 'gettext', 'bppiv_change_publish_button', 10, 2 );
function bppiv_change_publish_button( $translation, $text ) {
if ( 'bp3d-model-viewer' == get_post_type())
if ( $text == 'Publish' )
    return 'Save';

return $translation;
}

/*-------------------------------------------------------------------------------*/
/* Footer Review Request .
/*-------------------------------------------------------------------------------*/

add_filter( 'admin_footer_text','bppiv_admin_footer');	 
function bppiv_admin_footer( $text ) {
    if ( 'bp3d-model-viewer' == get_post_type() ) {
        $url = 'https://wordpress.org/plugins/3d-viewer/reviews/?filter=5#new-post';
        $text = sprintf( __( 'If you like <strong> 3D Viewer </strong> please leave us a <a href="%s" target="_blank">&#9733;&#9733;&#9733;&#9733;&#9733;</a> rating. Your Review is very important to us as it helps us to grow more. ', 'model-viewer' ), $url );
    }

    return $text;
}

/*-------------------------------------------------------------------------------*/
/* Shortcode Generator area  .
/*-------------------------------------------------------------------------------*/
	
add_action('edit_form_after_title','bppiv_shortcode_area');
function bppiv_shortcode_area(){
	global $post;	
	if($post->post_type =='bp3d-model-viewer') : ?>	
		<div class="shortcode_gen">
			<label for="bppiv_shortcode"><?php esc_html_e('Copy this shortcode and paste it into your post, page, or text widget content', 'model-viewer') ?>:</label>

			<span>
				<input type="text" id="bppiv_shortcode" onfocus="this.select();" readonly="readonly"  value="[3d_viewer id=<?php echo $post->ID; ?>]" /> 		
			</span>

		</div>
	<?php endif;
}

