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
        
        if($client_lat=="" || $client_long=="") {
            $client_loc = explode(",", $this->get_location_by_ip());
            $client_lat = $client_loc[0];
            $client_long = $client_loc[1];
        }

        $city = $this->get_city();

        $city_loc = explode(",", $this->get_coordinates_by_city($city));
        $city_lat = $city_loc[0];
        $city_long = $city_loc[1];

        $distance = $this->get_distance($client_lat, $client_long, $city_lat, $city_long);
        
        if( $distance < 20 ) {
            return true;
        }

        return false;
    }

    private function get_location_by_ip(){
        //$ip = !empty($this->input->server('HTTP_X_FORWARDED_FOR')) ? $this->input->server('HTTP_X_FORWARDED_FOR') : $this->input->server('REMOTE_ADDR');

        $ip = !empty($this->input->server('HTTP_X_FORWARDED_FOR')) ? $this->input->server('HTTP_X_FORWARDED_FOR') : '182.19.179.39';
        
        $response = json_decode(file_get_contents("http://ipinfo.io/{$ip}/json"));        

        return $response->loc; 
    }

    private function get_coordinates_by_city($city){
 
        $city = str_replace(" ", "+", $city); // replace all the white space with "+" sign to match with google search pattern
         
        $url = "http://maps.google.com/maps/api/geocode/json?sensor=false&address=$city";
         
        $response = json_decode(file_get_contents($url), TRUE);
         
        return ($response['results'][0]['geometry']['location']['lat'].",".$response['results'][0]['geometry']['location']['lng']);
     
    }

    function get_distance( $latitude1, $longitude1, $latitude2, $longitude2 ) {  

        $earth_radius = 6371;

        $dLat = deg2rad( $latitude2 - $latitude1 );  
        $dLon = deg2rad( $longitude2 - $longitude1 );  

        $a = sin($dLat/2) * sin($dLat/2) + cos(deg2rad($latitude1)) * cos(deg2rad($latitude2)) * sin($dLon/2) * sin($dLon/2);  
        $c = 2 * asin(sqrt($a));  
        $d = $earth_radius * $c;  

        return $d;  
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