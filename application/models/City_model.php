<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
/* 
 * Description: Location model class
 */
class City_model extends CI_Model{
	function __construct(){
        parent::__construct();
    }

    public function get_city(){

    	$query = $this->db->get('city');
        
        if($query->num_rows() > 0)
        {
            $row = $query->row();
            
            return $row;
        }

        return "";
    }

    public function save_city(){

        $id = $this->security->xss_clean($this->input->post('id'));
        $city = $this->security->xss_clean($this->input->post('city'));
        
        $data = array(
        'location' => $city,
        'modified_on' => @date('Y-m-d H:i:s')
        );

        $this->db->where('id', $id);
        $this->db->update('city', $data);
    }
}
?>