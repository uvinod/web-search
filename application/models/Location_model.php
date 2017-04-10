<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
/* 
 * Description: Location model class
 */
class Location_model extends CI_Model{
    function __construct(){
        parent::__construct();        
    }
    
    public function validate(){
        
        $client_lat = $this->security->xss_clean($this->input->post('lat'));
        $client_long = $this->security->xss_clean($this->input->post('long'));        
        
        $city = $this->get_city();

        $city_loc = explode(",", $this->get_coordinates_by_city($city));
        $city_lat = $city_loc[0];
        $city_long = $city_loc[1];

        $distance = $this->get_distance($client_lat, $client_long, $city_lat, $city_long);
        
        if( ($distance / 1000) < 20 ) {
            return true;
        }

        return false;
    }

    public function get_coordinates_by_city($city){
 
        $city = str_replace(" ", "+", $city); // replace all the white space with "+" sign to match with google search pattern
         
        $url = "http://maps.google.com/maps/api/geocode/json?sensor=false&address=$city";
         
        $response = json_decode(file_get_contents($url), TRUE);
         
        return ($response['results'][0]['geometry']['location']['lat'].",".$response['results'][0]['geometry']['location']['lng']);
     
    }    

    private function get_distance( $latitude1, $longitude1, $latitude2, $longitude2 ) {  

        $url = "http://maps.googleapis.com/maps/api/distancematrix/json?origins={$latitude1},{$longitude1}&destinations={$latitude2},{$longitude2}";
         
        $response = json_decode(file_get_contents($url), TRUE);

        $d = $response['rows'][0]['elements'][0]['distance']['value'];

        return $d;
    }

    public function get_location($lat, $long) {

        $address = "";

        $url = "http://maps.googleapis.com/maps/api/geocode/json?latlng=".$lat.",".$long."&sensor=true";

        $response = json_decode(file_get_contents($url), TRUE);        
        
        if($response!=null && count($response) > 0) {
            $address = $response['results'][0]['formatted_address'];
        }

        return $address;        
    }

    private function get_city()
    {
         $CI =& get_instance();
         $CI->load->model('city_model');

        $city = $CI->city_model->get_city();
        if($city!="") {
            
            return $city->location;
        }

         return "";
    }
}
?>