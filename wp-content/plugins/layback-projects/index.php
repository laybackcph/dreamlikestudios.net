<?php 
defined('ABSPATH') or die('No script kiddies please!'); 
    /*
     *  Plugin Name: Projects
     *  Plugin URI: https://laybackcph.dk
     *  Description: Projects Plugin
     *  Version: 1.0.0
     *  Author: Layback
     *  Author URI: https://laybackcph.dk
     *  Text Domain: layback
     *  License: GPL2
    */


/********************************************************************************************************************/
/***************************************************** LANGUAGE *****************************************************/
/********************************************************************************************************************/

    add_action('init', 'init_language_text_layback_project');
    function init_language_text_layback_project() 
    {
        load_plugin_textdomain('layback', false, basename( dirname( __FILE__ ) ) . '/languages' ); 
    }
    


/********************************************************************************************************************/
/*************************************************** HOOKS ***************************************************/
/********************************************************************************************************************/

    // Checks if wooocommerce (or anohter plugin is installed, if not deactivates this plugin)
    // add_action('admin_init', 'dpt_check_active_plugins');
    // function dpt_check_active_plugins()
    // {
    //     if(!is_plugin_active('woocommerce/woocommerce.php'))
    //     {
    //         deactivate_plugins('/woocommerce-checkout-privatecompany/woocommerce-checkout-privatecompany.php' );
    //     }   
    // }


/********************************************************************************************************************/
/*************************************************** REQUIRE FILES ***************************************************/
/********************************************************************************************************************/

    require_once dirname(__FILE__).'/class--main.php';
    $oLaybackProjectsMain = new LaybackProjectsMain();