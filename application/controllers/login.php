<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Login extends CI_Controller {

	function __construct() {
		parent::__construct();
	}


	/**     
     * Function to display login page with form
     * @access 	public     
     * @return 	View   Load landing page
     */
	public function index($msg = NULL)
	{
		$data['msg'] = $msg;

		$this->load->view('login/index.php', $data);
	}

	/**     
     * Function to process login
     * @access 	public     
     * @return 	Redirect  Redirect to landing page
     */
	public function process()
	{
        
        $this->load->model('login_model');
        
        $result = $this->login_model->validate();
        
        if(count($result) == 0) {       
		
            $msg = 'Invalid username and/or password.';

            $this->index($msg);

        } else {                    	        	

        	if($result['is_admin']) {
        		redirect(base_url().'configuration');	
        	}

        	$this->load->model('location_model');        	

        	$result = $this->location_model->validate();

        	if(! $result) {
        		$msg = 'You are not inside the 20 km radius.';

                $this->session->sess_destroy();
                
            	$this->index($msg);
        	} else {

        		redirect(base_url().'search');	

        	}
            
        }        
    }

    /**     
     * Function to logout the user
     * @access 	public     
     * @return 	Redirect Redirect to login
     */
	public function logout(){
        $this->session->sess_destroy();
        redirect(base_url().'login');
    }
}