<?php
/**
 * @package   Hello World Plugin for Joomla!
 * @author    Jon Brown https://quantumwarp.com/
 * @copyright Copyright (C) 2019 Jon Brown, All rights reserved.
 * @license   GNU/GPLv3 or later; https://www.gnu.org/licenses/gpl.html
 */

// No direct access
defined('_JEXEC') or die; ?>

<div class="<?php echo $this->_name ?>">
	<p><strong><?php echo JText::_('PLG_HELLOWORLD_DEFAULT_TMPL_MSG'); ?></strong></p>
	<p><?php echo JText::_('PLG_HELLOWORLD_HEADING_MSG'); ?></p>
	<?php if ($this->params->get('showMessage')) : ?>
		<p style="<?php echo $messageStyling ?>"><?php echo $helloWorldMessage; ?></p>
	<?php endif; ?>    
</div>