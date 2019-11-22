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

// Load the helper file (only once)
// require_once dirname(__FILE__) . '/helper.php'; // works - An older way of doing things
JLoader::register('PlgContentHelloWorldHelper', __DIR__ . '/helper.php'); // better - This uses the Joomla autoload feature

class PlgContentHelloWorld extends JPlugin
{
	/**
	 * Load the language file on instantiation. Note this is only available in Joomla 3.1 and higher.
	 * If you want to support 3.0 series you must override the constructor
	 *
	 * @var    boolean
	 * @since  3.1
	 */
	protected $autoloadLanguage = true;
	
	public function onAfterDispatch()
    {
        // Add CSS and JS to the <head> - This method allows overriding (was originally in onContentPrepare())
		JHtml::stylesheet('plg_helloworld/helloworld.css', array(), true);
		JHtml::script('plg_helloworld/helloworld.js', false, true);
    }

	/**
	 * Plugin method with the same name as the event will be called automatically.
	 * I think this just allows access to the main content
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
		
		/**
		* This retrieves the lang parameter we stored earlier. Note the second part
		* which assigns the default value of 1 if the parameter cannot be
		* retrieved for some reason.
		**/
		$language = $this->params->get('language', '1');
		
		// Load the message for the selected language
		$helloWorldMessage = PlgContentHelloWorldHelper::getHello($language);

		// Get Message Styling
		$messageStyling = $this->params->get('underlineMessage') ? 'text-decoration: underline;' : '';

		// Generate Content using a tempalte
		if($this->params->get('useTemplate')) {
			
			/* Render the input
			 * Based on onInstallerAddInstallationTab() from webinstaller.
			 * Can access $this-> inside template
			 */
			ob_start();
			include JPluginHelper::getLayoutPath('content', $this->_name, $this->params->get('layout', 'default'));
			$newCode = ob_get_clean();
		
		// Standard method for generating content
		} else {
			
			$newCode = "\n".'<div class="'.$this->_name.'">'."\n";			
			$newCode .= '<p><strong>'.JText::_('PLG_HELLOWORLD_NOTUSING_TMPL_MSG').'</strong></p>'."\n";
	        $newCode .= '<p>'.JText::_('PLG_HELLOWORLD_HEADING_MSG').'</p>'."\n";
			if ($this->params->get('showMessage')) { $newCode .= '<p style="'.$messageStyling.'">'.$helloWorldMessage.'</p>'."\n"; }
			$newCode .= '</div>'."\n";
		}
			
		// Replace all of the helloworld shortcode with the $newCode block
		$article->text = str_replace('{'.$this->params->get('shortcode').'}', $newCode, $article->text);
		
		return true;
		
	}
	/*
	 * I think you use this to access the whole page and not just content
	 */
	public function onAfterRender()
	{
		/*
		// Get page html which includes full page
        $body = $this->app->getBody();
        $content = "<h1>Hello World</h1>";
        // locate </body> tag and insert our own content right before </body>
        $body = str_replace('</body>', $content . '</body>', $body );
        // set the body
        $this->app->setBody($body);*/
	}

}
