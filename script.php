<?php
/**
 * @package   Hello World Plugin for Joomla!
 * @author    Jon Brown https://quantumwarp.com/
 * @copyright Copyright (C) 2019 Jon Brown, All rights reserved.
 * @license   GNU/GPLv3 or later; https://www.gnu.org/licenses/gpl.html
 */

// No direct access to this file
defined('_JEXEC') or die;
 
/*
 * class name of: plgContentHelloWorldInstallerScript (original) PlgContentHelloWorldInstallerScript = All work
 */
class plgContentHelloWorldInstallerScript
{
	/**
	 * This method is called after a plugin is installed.
	 *
	 * @param  \stdClass $parent - Parent object calling this method.
	 *
	 * @return void
	 */
	function install($parent) 
	{
		echo '<p>' . JText::_('PLG_CONTENT_HELLOWORLD_INSTALL_TEXT') . '</p>';
		//$parent->getParent()->setRedirectURL('index.php?option=mod_helloworld');
	}
 
	/**
	* This method is called after a plugin is uninstalled.
	*
	* @param  \stdClass $parent - Parent object calling this method.
	*
	* @return void
	*/
	function uninstall($parent) 
	{
		echo '<p>' . JText::_('PLG_CONTENT_HELLOWORLD_UNINSTALL_TEXT') . '</p>';
	}
 
	/**
	* This method is called after a plugin is updated.
	*
	* @param  \stdClass $parent - Parent object calling object.
	*
	* @return void
	*/
	function update($parent) 
	{		
		echo '<p>' . JText::sprintf('PLG_CONTENT_HELLOWORLD_UPDATE_TEXT', $parent->get('manifest')->version) . '</p>';
	}
 
	/**
     * Runs just before any installation action is performed on the plugin. (install/update/uninstall method)
     * Verifications and pre-requisites should run in this function.
     *
     * @param  string    $type   - Type of PreFlight action. Possible values are:
     *                           - * install
     *                           - * update
     *                           - * discover_install
     * @param  \stdClass $parent - Parent object calling object.
     *
     * @return void
     */
	function preflight($type, $parent) 
	{
		echo '<p>' . JText::_('PLG_CONTENT_HELLOWORLD_PREFLIGHT_' . $type . '_TEXT') . '</p>';
	}
 
	/**
	* Runs right after any installation action is performed on the plugin. (install/update/uninstall method)
	*
	* @param  string    $type   - Type of PostFlight action. Possible values are:
	*                           - * install
	*                           - * update
	*                           - * discover_install
	* @param  \stdClass $parent - Parent object calling object.
	*
	* @return void
	*/
	function postflight($type, $parent) 
	{
		echo '<p>' . JText::_('PLG_CONTENT_HELLOWORLD_POSTFLIGHT_' . $type . '_TEXT') . '</p>';
	}
}