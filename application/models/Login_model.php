<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
/*
 * Description: Login model class
 */
class Login_model extends CI_Model{
    function __construct(){
        parent::__construct();
    }
    
    public function validate(){

    	$data = array();

        $username = $this->security->xss_clean($this->input->post('username'));
        $password = $this->security->xss_clean($this->input->post('password'));

        $client_lat = $this->security->xss_clean($this->input->post('lat'));
        $client_long = $this->security->xss_clean($this->input->post('long'));        
        
        $this->db->where('username', $username);
        $this->db->where('password', $password);        

        $query = $this->db->get('user');
        
        if($query->num_rows() == 1)
        {
            
            $CI =& get_instance();
            $CI->load->model('location_model');

            $location = $CI->location_model->get_location($client_lat, $client_long);

            $row = $query->row();
            $data['userid'] = $row->id;
            $data['fname'] = $row->name;
            $data['username'] = $row->username;
            $data['is_admin'] = $row->is_admin;
            $data['is_admin'] = $row->is_admin;
            $data['lat'] = $client_lat;
            $data['long'] = $client_long;
            $data['location'] = $location;
            $data['validated'] = true;
            
            $this->session->set_userdata($data);
            
        }
        return $data;
    }
}
?>