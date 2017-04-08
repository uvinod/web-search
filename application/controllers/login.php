<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class login extends CI_Controller {

	function __construct() {
		parent::__construct();
		
		$this->load->helper('url'); //Load URL Helper
	}


	/**     
     * Function to display login page with form
     * @access 	public     
     * @return 	View   Load landing page
     */
	public function index()
	{
		$this->load->view('login/index.php');
	}
}