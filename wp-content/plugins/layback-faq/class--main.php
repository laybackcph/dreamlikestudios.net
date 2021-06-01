<?php
defined('ABSPATH') or die('No script kiddies please!');
/**
 * The core plugin class.
 *
 * This is used to define internationalization, admin-specific hooks, and
 * public-facing site hooks.
 *
 * Also maintains the unique identifier of this plugin as well as the current
 * version of the plugin.
 *
 * @since      1.0.0
 * @author     Laybackcph <system@laybackcph.dk>
 */
class LaybackFAQMain 
{
	protected $iVersion;
	protected $sPluginName;
	protected $sTextDomain;
	protected $sPrefix;
	protected $sPluginNameTag;


	protected $oAdmin;
	protected $oPublic;
	protected $oFunctions;
	protected $oSettings;

	public function __construct() 
	{
		if (defined('LAYBACK_MAIL_VERSION')) 
		{
			$this->iVersion = LAYBACK_MAIL_VERSION;
		} 
		else 
		{
			$this->iVersion = '1.0.0';
		}

		$this->sPluginName  	= 'FAQ';
		$this->sTextDomain  	= 'layback';
		$this->sPluginNameTag  	= 'faq';
		$this->sPrefix 			= 'dlfq';
		$this->load_dependencies();
		$this->load_posttypes();
	}

	private function load_dependencies() 
	{
		// require_once dirname( __FILE__ ) . '/inc/admin/class--admin.php';
		require_once dirname( __FILE__ ) . '/inc/public/class--public.php';
		// require_once dirname( __FILE__ ) . '/inc/functions/class--functions.php';
		// require_once dirname( __FILE__ ) . '/inc/settings/class--settings.php';

		// $this->oFunctions	= new Layback_Mail_Functions($this->sTextDomain, $this->sPrefix, $this->sPluginName, $this->sPluginNameTag);
		// $this->oAdmin 		= new Layback_Mail_Admin($this->sTextDomain, $this->sPrefix, $this->sPluginName, $this->sPluginNameTag, $this->oFunctions);
		$this->oPublic 			= new LaybackFAQPublic($this->sTextDomain, $this->sPrefix, $this->sPluginName, $this->sPluginNameTag, $this->oFunctions);
		// $this->oSettings 	= new Layback_Mail_Settings($this->sTextDomain, $this->sPrefix, $this->sPluginName, $this->sPluginNameTag, $this->oFunctions);

		add_filter('single_template', array($this, 'load_posttypes_single_template'));
		add_filter('archive_template', array($this, 'load_posttypes_archive_template'));
		add_filter('template_include', array($this, 'load_posttypes_search_template'));
	}

	public function load_posttypes()
	{
	    foreach(glob(plugin_dir_path(( __FILE__ )).'posttypes/*.php') as $sIncludesFilename)
	    {
	        require_once($sIncludesFilename);
	    }
	}


	function load_posttypes_search_template($template)   
	{    
		global $wp_query;   
		$post_type = get_query_var('post_type');   
		if(count(scandir(plugin_dir_path(( __FILE__ )).'posttypes/')) > 0)
        {
	    	foreach(scandir(plugin_dir_path(( __FILE__ )).'posttypes/') as $sFilename)
		    {
		     	if($sFilename === '.' || $sFilename === '..')
		     	{
		     		continue;
		     	}
		     	$sPostType = str_replace('.php', '', $sFilename);
				if($wp_query->is_search && $post_type == $sPostType)   
				{
					if(file_exists(plugin_dir_path(( __FILE__ )).'templates/search-'.$sPostType.'.php'))
					{
				    	return plugin_dir_path(( __FILE__ )).'templates/search-'.$sPostType.'.php';
					}
				}   
		    }
        }
        return $template;   
	}

    public function load_posttypes_archive_template($template) 
    {      
        global $wp_query;
        if(count(scandir(plugin_dir_path(( __FILE__ )).'posttypes/')) > 0)
        {
	    	foreach(scandir(plugin_dir_path(( __FILE__ )).'posttypes/') as $sFilename)
		    {
		     	if($sFilename === '.' || $sFilename === '..')
		     	{
		     		continue;
		     	}
		     	$sPostType = str_replace('.php', '', $sFilename);
		        if(is_post_type_archive($sPostType)) 
		        {
		            $templates[] = 'archive-'.$sPostType.'.php';
		            $template = $this->layback_documation_locate_plugin_template($templates);
		        }
		    }
        }
        return $template;
    }


    public function load_posttypes_single_template($template) 
    {  
        global $wp_query;
        if(count(scandir(plugin_dir_path(( __FILE__ )).'posttypes/')) > 0)
        {
	    	foreach(scandir(plugin_dir_path(( __FILE__ )).'posttypes/') as $sFilename)
		    {
		     	if($sFilename === '.' || $sFilename === '..')
		     	{
		     		continue;
		     	}
		     	$sPostType = str_replace('.php', '', $sFilename);
		        if(is_singular($sPostType)) 
		        {
		            $templates[] = 'single-'.$sPostType.'.php';
		            $template = $this->layback_documation_locate_plugin_template($templates);
		        }
		    }
        }
        return $template;
    }



    public function layback_documation_locate_plugin_template($template_names, $load = false, $require_once = true) 
    {
        if (!is_array($template_names)) 
        {
            return '';
        }
        $located = '';  
        $sPluginDirPath = plugin_dir_path(( __FILE__ ));
        $sThemeDirPath 	= get_stylesheet_directory();
      
        foreach($template_names as $template_name) 
        {
            if(!$template_name)
            {
                continue;
            }
            if(file_exists($sThemeDirPath . '/' . $template_name)) 
            {
                $located = $sThemeDirPath . '/' . $template_name;
                break;
            } 
            else if(file_exists($sPluginDirPath . 'templates/' . $template_name)) 
            {
                $located =  $sPluginDirPath . 'templates/' . $template_name;
                break;
            }
        }
        if($load && $located != '') 
        {
            load_template($located, $require_once);
        }
        return $located;
    }


	public function get_plugin_name() 
	{
		return $this->sPluginName;
	}

	public function get_plugin_version() 
	{
		return $this->iVersion;
	}

	public function get_plugin_text_domain() 
	{
		return $this->sTextDomain;
	}

	public function get_plugin_prefix() 
	{
		return $this->sPrefix;
	}

	public function get_plugin_admin() 
	{
		return $this->oAdmin;
	}

	public function get_plugin_public() 
	{
		return $this->oPublic;
	}

	public function get_plugin_function() 
	{
		return $this->oFunctions;
	}

	public function get_plugin_settings() 
	{
		return $this->oSettings;
	}
}
