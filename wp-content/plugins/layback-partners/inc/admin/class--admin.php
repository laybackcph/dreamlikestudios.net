<?php
defined('ABSPATH') or die('No script kiddies please!');

class Layback_Mail_Admin
{
	protected $sPluginName;
	protected $sPluginNameTag;
	protected $sTextDomain;
	protected $sPrefix;
	protected $oFunctions;

	public function __construct($sTextDomain, $sPrefix, $sPluginName, $sPluginNameTag, $oFunctions) 
	{
		$this->sPluginName 		= $sPluginName;
		$this->sPluginNameTag 	= $sPluginNameTag;
		$this->sTextDomain 		= $sTextDomain;
		$this->sPrefix 			= $sPrefix;
		$this->oFunctions 		= $oFunctions;
		$this->load_admin_dependencies();
	}

	private function load_admin_dependencies() 
	{
		//enque css
		add_action('admin_enqueue_scripts', array($this, 'enqueue_script_admin'));

		//enque js
		add_action('admin_enqueue_scripts', array($this, 'enqueue_css_admin'));
	}

	   
    public function enqueue_script_admin()
    {
        $aParams = array
        (

        );
    	// if(is_post_type_archive('task'))
    	// {
	    //     wp_register_script($this->sPrefix.'admin_archive', plugins_url('', __FILE__).'/js/admin_archive.js', array('jquery'), filemtime(dirname(__FILE__).'/js/admin_archive.js'));
	    //     wp_enqueue_script($this->sPrefix.'admin_archive');
	    //     wp_localize_script($this->sPrefix.'admin_archive', 'sParam', $aParams);
    	// }

    	// if(is_singular('task'))
    	// {
	    //     wp_register_script($this->sPrefix.'admin_single', plugins_url('', __FILE__).'/js/admin_single.js', array('jquery'), filemtime(dirname(__FILE__).'/js/admin_single.js'));
	    //     wp_enqueue_script($this->sPrefix.'admin_single');
	    //     wp_localize_script($this->sPrefix.'admin_single', 'sParam', $aParams);
    	// }
    	

    	wp_register_script($this->sPrefix.'admin_everywhere', plugins_url('', __FILE__).'/js/admin_everywhere.js', array('jquery'), filemtime(dirname(__FILE__).'/js/admin_everywhere.js'));
	    wp_enqueue_script($this->sPrefix.'admin_everywhere');
	    wp_localize_script($this->sPrefix.'admin_everywhere', 'sParam', $aParams);
    }

    public function enqueue_css_admin()
    {
        wp_enqueue_style($this->sPrefix.'admin', plugins_url('', __FILE__).'/css/admin.css', array(), filemtime(dirname(__FILE__).'/css/admin.css'));
    }
}
