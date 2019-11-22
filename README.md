# Hello World Plugin for Joomla!

This is a ready to go Joomla plugin template that you can use to build your own plugins. I have added all the settings, elements and things I could find.

## What does it do?
This is a content plugin that replaces a user defined shortcode with some content; date, WYSIWYG content and a language sensitive Hello World statement.

## How to use this module
- install the plugin.
- configure the plugin how you want it.
- insert your shortcode into an article.
- load the newly saved article and you should see the shortcode has been replaced with the content you configured in the plugin admin.

## Notes
- You can restrict this plugin to work only on certain components using $context.

## Compatibility
plg_helloworld is fully compatible with Joomla versions 3.x (possibly 3.8+) and 4.x. A few alterations and the plugin  will work on earlier versions of Joomla.

## License
plg_helloworld is a Joomla module developed by QuantumWarp and released under the GNU General Public License.

## Learn More
Visit the extension's software page at: https://quantumwarp.com/

## References
I used the following links and resources to build this plugin.
- https://quantumwarp.com/kb/articles/106-extension-development/671-creating-a-joomla-plugin
- https://docs.joomla.org/J3.x:Creating_a_Plugin_for_Joomla
- https://docs.joomla.org/J3.x:Creating_a_content_plugin - This describes plugin events and their functions related to content.
- https://docs.joomla.org/Plugin/Events/System - This describes plugin events and their functions related to the system.
- https://docs.joomla.org/J3.x:Developing_an_MVC_Component/Adding_an_install-uninstall-update_script_file
- https://docs.joomla.org/Manifest_files
- https://docs.joomla.org/Standard_form_field_types
- https://docs.joomla.org/Using_own_library_in_your_extensions
- https://joomla.stackexchange.com/questions/24685/joomla-4-how-to-set-namespace-for-custom-field-addfieldprefix
- https://joomla.digital-peak.com/images/blog/JWC17_Prepare_you_extension_for_Joomla_4.pdf
- https://docs.joomla.org/Plugin/Events/Content
- https://docs.joomla.org/J3.x:OnContentPrepare_called_with_JCategoryNode - Example of $context. This can be used to specify to only rung this plugin for a certain component.
- https://docs.joomla.org/Triggering_content_plugins_in_your_extension
- https://www.vishalon.net/blog/create-joomla-extension-to-show-hello-world-on-every-page