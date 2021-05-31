<?php
defined('ABSPATH') or die('No script kiddies please!');

class Layback_Mail_Settings
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
		$this->oFunctions		= $oFunctions;
		$this->load_settings_dependencies();
		$this->run();
	}

	private function load_settings_dependencies() 
	{
		
	}

	public function run()
	{
		add_action('admin_init', array($this, 'theme_settings_init'));
		add_action('admin_menu', array($this, 'add_settings_page'));
	}

	// Register settings
	public function theme_settings_init()
	{
		register_setting($this->sPrefix.'_settings_options', $this->sPrefix.'_settings_options');
	}
	// add settings page to menu
	public function add_settings_page() 
	{
		add_menu_page(__($this->sPluginName), __($this->sPluginName), 'manage_options', $this->sPrefix.'_settings_options', array($this, 'theme_settings_page'), 'dashicons-admin-network', 58);
	}

	public function theme_settings_page() 
	{
		$this->page_content();
	}

	public function page_content()
	{
		?>
		<form method="post" action="options.php"> 
			<?php
				wp_nonce_field('update-options');
				settings_fields($this->sPrefix.'_settings_options');
				$settingsOptions = get_option($this->sPrefix.'_settings_options');
				include('setting-pages/page-content.php');
			?>
		</form> 
		<?php 
	}
}
