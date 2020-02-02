<?php
/**
 * @package   Hello World Plugin for Joomla!
 * @author    Jon Brown https://quantumwarp.com/
 * @copyright Copyright (C) 2019 Jon Brown, All rights reserved.
 * @license   GNU/GPLv3 or later; https://www.gnu.org/licenses/gpl.html
 */

// No direct access
defined('_JEXEC') or die;

class PlgContentHelloWorldHelper
{
	/**
	 * Class Constructor
     * 
	 * @access public
	 */  
    public function __construct()
    {
    }
	
	/**
	 * Retrieves the hello message
	 *
	 * @param   array  $params An object containing the module parameters
	 *
	 * @access public
	 */    
	public static function getHello($params)
	{
		// Obtain a database connection
		$db = JFactory::getDbo();
		
		// Retrieve the shout - note we are now retrieving the id not the lang field.
		$query = $db->getQuery(true)
					->select($db->quoteName('hello'))
					->from($db->quoteName('#__plg_content_helloworld'))
					->where('id = '. $db->Quote($params));
		
		// Prepare the query
		$db->setQuery($query);
		
		// Load the row.
		$result = $db->loadResult();
		
		// Return the Hello
		return $result;
	}
	
	public function downloadCsvAction()
	{            
        // Output headers so that the file is downloaded rather than displayed
        header('Content-Type: text/csv; charset=utf-8');
        header('Content-Disposition: attachment; filename=HelloWorld.csv');

        // Create a file pointer connected to the output stream
        $output_stream = fopen('php://output', 'w');

        // Output the column headings
        fputcsv($output_stream, array(\JText::_('PLG_CONTENT_HELLOWORLD_AJAX_RECORD_NAME'), \JText::_('PLG_CONTENT_HELLOWORLD_AAJX_RECORD_TYPE')));

		// Demo Content
		$records = array(
						array('Orange', 'Fruit'),
						array('Apple', 'Fruit'),
						array('Potato', 'Vegetable'),
						array('Carrot', 'Vegetable'),			
		);		
		
        // loop over the records, outputting them as rows
        foreach($records as $record) {
            $row = array($record[0], $record[1]);
            fputcsv($output_stream, $row);            
        }       

        // close the csv file
        fclose($output_stream);
        
        // Prevent further actions
        exit();
	}
	
	public function addMessageAction()
	{            
		$result = '<script>jQuery(".browser-message").html("'.JTEXT::_('PLG_CONTENT_HELLOWORLD_AJAX_ADDED_MESSAGE_MSG').'");</script>';
		return $result;
	}
	
	public function removeMessageAction()
	{            
		$result = '<script>jQuery(".browser-message").html("");</script>';
		return $result;
	}

	public function alertMessageAction()
	{
		$result = '<script>alert("'.JTEXT::_('PLG_CONTENT_HELLOWORLD_AJAX_ALERT_MESSAGE_MSG').'");</script>';
        return $result;
	}	
	
}


