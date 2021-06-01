<?php
defined('ABSPATH') or die('No script kiddies please!');
class LaybackTeamPublic
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
		$this->load_public_dependencies();
	}

	private function load_public_dependencies() 
	{
		//enque css
		add_action('wp_enqueue_scripts', array($this, 'enqueue_script_public'));

		//enque js
		add_action('wp_enqueue_scripts', array($this, 'enqueue_css_public'));
	}

	   
    public function enqueue_script_public()
    {
        $aParams = array
        (

        );
    	// if(is_post_type_archive('task'))
    	// {
	    //     wp_register_script($this->sPrefix.'public_archive', plugins_url('', __FILE__).'/js/public_archive.js', array('jquery'), filemtime(dirname(__FILE__).'/js/public_archive.js'));
	    //     wp_enqueue_script($this->sPrefix.'public_archive');
	    //     wp_localize_script($this->sPrefix.'public_archive', 'sParam', $aParams);
    	// }

    	// if(is_singular('task'))
    	// {
	    //     wp_register_script($this->sPrefix.'public_single', plugins_url('', __FILE__).'/js/public_single.js', array('jquery'), filemtime(dirname(__FILE__).'/js/public_single.js'));
	    //     wp_enqueue_script($this->sPrefix.'public_single');
	    //     wp_localize_script($this->sPrefix.'public_single', 'sParam', $aParams);
    	// }
    	

    	wp_register_script($this->sPrefix.'public_everywhere', plugins_url('', __FILE__).'/js/public_everywhere.js', array('jquery'), filemtime(dirname(__FILE__).'/js/public_everywhere.js'));
	    wp_enqueue_script($this->sPrefix.'public_everywhere');
	    wp_localize_script($this->sPrefix.'public_everywhere', 'sParam', $aParams);
    }

    public function enqueue_css_public()
    {
        wp_enqueue_style($this->sPrefix.'public', plugins_url('', __FILE__).'/css/public.css', array(), filemtime(dirname(__FILE__).'/css/public.css'));
    }
}
