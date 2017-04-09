<?php
defined('BASEPATH') OR exit('No direct script access allowed');	

/**     
 * Function to retrieve results from web api for a keyword
 * @access 	public     
 * @return 	Array   Web Search results
 */

function get_web_search_results($keyword, $page, $per_page, $domain)
{	

	$search = $domain == 'google' ? new GoogleCustomSearch() : new BingSearch();
	$results = $search->search($keyword, $page, $per_page);	

	return $results;
}


/**     
 * Function to count results from web api for a keyword
 * @access 	public     
 * @return 	Int   Web Search results count
 */

function get_web_search_results_count($keyword, $domain)
{	

	$total_count = 0;

	$search = $domain == 'google' ? new GoogleCustomSearch() : new BingSearch();
	$results = $search->search($keyword);	
	
	$total_count = $results->totalResults;
	
	return $total_count;
}

/**     
 * Function to check if the user is validated
 * @access 	public     
 * @return 	Boolean  
 */
function check_isvalidated($is_admin){

	$CI = & get_instance();	

	if($CI->session->userdata('validated') && $CI->session->userdata('is_admin') == $is_admin) {

		return true;
	}
    
    return false;
}
?>