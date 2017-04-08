<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class search extends CI_Controller {

	function __construct() {
		parent::__construct();		

		$this->load->library('GoogleCustomSearch');
		$this->load->library('BingSearch');
		$this->load->library('Ajax_Pagination');
		$this->load->helper('url'); //Load URL Helper		
		$this->load->helper('custom');
		$this->perPage = 10;
	}


	/**     
     * Function to display login page with form
     * @access 	public     
     * @return 	View   Load landing page
     */
	public function index()
	{
		$this->load->view('search/index.php');
	}

	/**     
     * Function to retrieve results from google or bing
     * @access 	public          
     * @return 	View   display results from google
     */
	public function get_web_search_results()
	{

		$domain = $this->input->post('domain');
		$keyword = $this->input->post('keyword');
		$page = $this->input->post('page');
		
		if(!$page) {
            $offset = 0;
        } else {
            $offset = $page;
        }        

		$data['results'] = get_web_search_results($keyword, $offset == 0 ? 1 : ($offset / $this->perPage) + 1, $this->perPage, $domain);
		$data['domain'] = $domain;

		$config['total_rows'] = get_web_search_results_count($keyword, $domain);
		
    	$config['per_page'] = $this->perPage;
    	$config['display_pageno'] = true;

    	$this->ajax_pagination->initialize($config);

		$this->load->view('search/_web_search_results.php', $data);
	}

}