<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class configuration extends CI_Controller {

	function __construct() {
		parent::__construct();		

		$this->load->helper('custom');

		$this->check_isvalidated(1);
		
	}

	/**     
     * Function to check if the user is validated
     * @access 	public     
     * @return 	Redirect Redirect to login
     */
	private function check_isvalidated(){
        if(! check_isvalidated(1)){
            redirect(base_url().'login');
        }
    }

    /**     
     * Function to display configuration page, save configuration
     * @access 	public     
     * @return 	View   Load landing page
     */
	public function index()
	{

		$this->load->model('city_model');    
		
		if ($this->input->server('REQUEST_METHOD') == 'POST') {

			$this->city_model->save_city();

			$this->session->set_flashdata('msg', 'City Updated Successfully!');

			redirect(base_url().'configuration');	
		}

		$city = $this->city_model->get_city();
		if($city!="") {
			$data['id'] = $city->id;
			$data['city'] = $city->location;
		}

		$this->load->view('configuration/index.php', $data);
	}
}
