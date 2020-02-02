<?php
/**
 * @package   Hello World Plugin for Joomla!
 * @author    Jon Brown https://quantumwarp.com/
 * @copyright Copyright (C) 2019 Jon Brown, All rights reserved.
 * @license   GNU/GPLv3 or later; https://www.gnu.org/licenses/gpl.html
 */
 
// No direct access
defined('_JEXEC') or die;

// Load the helper file (only once)
// require_once dirname(__FILE__) . '/helper.php'; // works - An older way of doing things

// Load the helper file via Joomla's Autoload feature
JLoader::register('PlgContentHelloWorldHelper', __DIR__ . '/helper.php');

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
	
    /**
	 * Class Constructor
     * 
	 * @access public
     * 
     * Not currently used.
	 *  
    public function __construct($subject, $config)
    {   
        // Require when using a constructor in this class
		parent::__construct($subject, $config);
    }*/	
	
	public function onAfterDispatch()
    {
        // Add CSS and JS to the <head> - This method allows overriding (was originally in onContentPrepare()) -  is this the best place
		JHtml::stylesheet('plg_content_'.$this->_name.'/style.css', array(), true);
		JHtml::script('plg_content_'.$this->_name.'/javascript.js', false, true);
		JHtml::stylesheet('plg_content_'.$this->_name.'/helloworld.css', array(), true);
		JHtml::script('plg_content_'.$this->_name.'/helloworld.js', false, true);
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
			
			$newCode = "\n".'<div class="'.'plg_content_'.$this->_name.'">'."\n";			
			$newCode .= '<p><strong>'.JText::_('PLG_CONTENT_HELLOWORLD_NOTUSING_TEMPLATE_MSG').'</strong></p>'."\n";
	        $newCode .= '<p>'.JText::_('PLG_CONTENT_HELLOWORLD_HEADING_MSG').'</p>'."\n";
			if ($this->params->get('showMessage')) { $newCode .= '<p style="'.$messageStyling.'">'.$helloWorldMessage.'</p>'."\n"; }			
			$newCode .= '<div class="browser-message"></div>'."\n";
			$newCode .= '<div class="form-actions">'."\n";
			$newCode .= '<input type="button" class="btn btn-info" value="' . JText::_('PLG_CONTENT_HELLOWORLD_BUTTON_DOWNLOAD_CSV') . '" onclick="PlgContentHelloWorld.ajaxAction(\'downloadCsv\')" />'."\n";
			$newCode .= '<input type="button" class="btn btn-warning" value="' . JText::_('PLG_CONTENT_HELLOWORLD_BUTTON_ADD_MESSAGE') . '" onclick="PlgContentHelloWorld.ajaxAction(\'addMessage\')" />'."\n";
			$newCode .= '<input type="button" class="btn btn-warning" value="' . JText::_('PLG_CONTENT_HELLOWORLD_BUTTON_REMOVE_MESSAGE') . '" onclick="PlgContentHelloWorld.ajaxAction(\'removeMessage\')" />'."\n";
			$newCode .= '<input type="button" class="btn btn-success" value="' . JText::_('PLG_CONTENT_HELLOWORLD_BUTTON_ALERT_MESSAGE') . '" onclick="PlgContentHelloWorld.ajaxAction(\'alertMessage\')" />'."\n";
			$newCode .= '</div>'."\n";
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

        // Locate </body> tag and insert our own content right before </body>
        $body = str_replace('</body>', $content . '</body>', $body );

        // Set the body
        $this->app->setBody($body);
		 */
	}
	
    /**
	 * com_ajax entry point for PlgContentHelloWorld
	 * Plugins only have a single entry point for com_ajax
	 * This method has been modified to allow different sub-methods to be called from the helper class.	
	 * Normally you only need to use this function without the helper class.
	 * I have put the other functions in the helper class to keep this file uncluttered.
	 * use GET or POST for variables or even a mix
	 * Access this function with: index.php?option=com_ajax&group=content&plugin=helloworld&format=raw&method={SUBMETHOD}
	 * swap {SUBMETHOD} with the name of your subfunciton i.e. joomlaInstallModifiedAction
	 * if you dont want to use sub-methods you only need to use: index.php?option=com_ajax&group=content&plugin=helloworld&format=raw
	 * sub-methods can be called statically if required, just alter the code below accordingly.
	 *
	 * @since   1.0.0
	 */
    public function onAjaxHelloWorld()
    {              
        $app = JFactory::getApplication();        
        
        // Get the method parameter (com_ajax does not have native ability to process parameters)
        $method = $app->input->getString('method').'Action';
        
        // Instanciate the Helper Class
        $helper = new PlgContentHelloWorldHelper();
                       
        // Check the specified method exists in the Helper Class
        if(method_exists($helper, $method))
        {   
			// Run the specified method
            $result = $helper->$method();			
		} else {			
            $result = false;
        }
		
		// Return the response to com_ajax
		return $result;
    }	

}
