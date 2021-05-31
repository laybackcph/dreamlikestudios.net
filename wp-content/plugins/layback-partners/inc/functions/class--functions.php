<?php
defined('ABSPATH') or die('No script kiddies please!');

class Layback_Mail_Functions
{
	protected $sPluginName;
	protected $sPluginNameTag;
	protected $sTextDomain;
	protected $sPrefix;

	public function __construct($sTextDomain, $sPrefix, $sPluginName, $sPluginNameTag) 
	{
		$this->sPluginName 		= $sPluginName;
		$this->sPluginNameTag 	= $sPluginNameTag;
		$this->sTextDomain 		= $sTextDomain;
		$this->sPrefix 			= $sPrefix;
		$this->load_general_dependencies();
	}

	private function load_general_dependencies() 
	{

	}
}
