/**
 * @package   Hello World Plugin for Joomla!
 * @author    Jon Brown https://quantumwarp.com/
 * @copyright Copyright (C) 2019 Jon Brown, All rights reserved.
 * @license   GNU/GPLv3 or later; https://www.gnu.org/licenses/gpl.html
 */

// A $( document ).ready() block.
jQuery(document).ready(function() {     
	// Not currently Used
});

PlgContentHelloWorld =
{
	// Perform Ajax Action
	ajaxAction: function(method) {   

		// Perform the ajax request and handle the response - Async is off so functions are processed in order.
		jQuery.ajax({
			url: "index.php?option=com_ajax",
			type: "POST",
			async: false,
			data:
			{ 
				group: "content",
				plugin: "helloworld",
				format: "raw",
				method: method
			},
			success: function(response) { PlgContentHelloWorld.handleResponse(method, response); },
			error: function(response) { PlgContentHelloWorld.handleResponse(method, response); }
		});

	},

	// Handle the output of the response
	handleResponse: function(method, response) { 

		// If the reponse is from downloadCsv
		if (method === "downloadCsv") {   

			// A real DOM element is required for these actions to work (this is a workaround)
			let hiddenElement = document.createElement("a");

			// Build the hidden element
			hiddenElement.href = "data:text/csv;charset=utf-8," + encodeURIComponent(response);
			hiddenElement.target = "_blank";
			hiddenElement.download = "HelloWorld.csv";

			// Execute the hidden element
			hiddenElement.click();   
			
			// Stop further processing here
			return;
		
		// All other responses are Javascript should be executed
		} else {			
			jQuery('body').append(response);
		}
		
	}

};
