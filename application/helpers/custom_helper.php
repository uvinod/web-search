<?php
defined('BASEPATH') OR exit('No direct script access allowed');	

/**     
 * Function to retrieve results from web api for a keyword
 * @access 	public     
 * @return 	Array   Web Search results
 */
if ( ! function_exists('get_web_search_results'))	
{
	function get_web_search_results($keyword, $page, $per_page, $domain)
	{	

		$search = $domain == 'google' ? new GoogleCustomSearch() : new BingSearch();
		$results = $search->search($keyword, $page, $per_page);	

		return $results;
	}
}

/**     
 * Function to count results from web api for a keyword
 * @access 	public     
 * @return 	Int   Web Search results count
 */
if ( ! function_exists('get_web_search_results_count'))	
{
	function get_web_search_results_count($keyword, $domain)
	{	

		$total_count = 0;

		$search = $domain == 'google' ? new GoogleCustomSearch() : new BingSearch();
		$results = $search->search($keyword);	
		
		$total_count = $results->totalResults;
		
		return $total_count;
	}
}
?>