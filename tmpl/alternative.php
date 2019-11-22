<?php
/*
 * @package   Hello World Module for Joomla!
 * @author    Jon Brown https://quantumwarp.com/
 * @copyright Copyright (C) 2019 Jon Brown, All rights reserved.
 * @license   GNU/GPLv3 or later; https://www.gnu.org/licenses/gpl.html
 */

/** My Notes
 * This is the template file for the frontend display
 * You can use the config varibles here and other variables from mod_helloworld.php
 *
 * An important point to note is that the template file has the same scope as the mod_helloworld.php file.
 * What this means is that the variable $hello can be defined in the mod_helloworld.php file
 * and then used in the template file without any extra declarations or function calls. 
*/

// No direct access
defined('_JEXEC') or die; ?>

<div class="<?php echo $this->_name ?>">
	<p><strong><?php echo JText::_('PLG_HELLOWORLD_ALTERNATIVE_TMPL_MSG'); ?></strong></p>
	<p><?php echo JText::_('PLG_HELLOWORLD_HEADING_MSG'); ?></p>
	<?php if ($this->params->get('showMessage')) : ?>
		<p style="<?php echo $messageStyling ?>"><?php echo $helloWorldMessage; ?></p>
	<?php endif; ?>    
</div>