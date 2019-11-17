<?php
/*
 * HelloWorld Module Entry Point
 * 
 * @package   HelloWorld Plugin for Joomla! 3.x
 * @author    Jon Brown https://quantumwarp.com/
 * @copyright Copyright (C) 2019 Jon Brown, All rights reserved.
 * @copyright Copyright (C) 2005 - 2019 Open Source Matters, Inc. All rights reserved.
 * @license   GNU/GPLv3 or later; https://www.gnu.org/licenses/gpl.html
 */
 
// No direct access
defined('_JEXEC') or die;

// Load the helper file
require_once(dirname(__FILE__) . DS . 'helper.php');

class plgContentHelloWorld extends JPlugin
{
	/**
	 * Load the language file on instantiation. Note this is only available in Joomla 3.1 and higher.
	 * If you want to support 3.0 series you must override the constructor
	 *
	 * @var    boolean
	 * @since  3.1
	 */
	protected $autoloadLanguage = true;

	/**
	 * Plugin method with the same name as the event will be called automatically.
	 */
	public function onContentPrepare($context, &$article, &$params, $page = 0)
	 {
		/*
		 * Plugin code goes here.
		 * You can access database and application objects and parameters via $this->db,
		 * $this->app and $this->params respectively
		 */
		
		/* Build the Content to replace the shortcode */
		
		// Placeholder for new code
		$newCode = '';
        
        // If there is a Date set, create this section
		if($this->params->get('date')) {
			$newCode .= '<div class="hello_world_shortcode date"><h1>'.$this->params->get('date').'</h1></div>';
		}
		
		// Add the new content from the WYSIWYG into the placeholder
		$newCode .= '<div class="hello_world_shortcode content">'.$this->params->get('content').'</div>';
		
		// Add the Hello World Message from the database to the bottom of the content for the select language
		$newCode .= '<div class="hello_world_shortcode content"><h2>'.plgHelloWorldHelper::getHello($this->params->get('lang')).'</h2></div>';
		
        // Replace all of the helloworld shortcode with the $newCode block
        $article->text = str_replace('{'.$this->params->get('shortcode').'}', $newCode, $article->text);
		
		return true;
	}
}