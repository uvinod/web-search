<?php 
	/*
	 * Simple PHP 5 cURL Wrapper for the Bing Search API via Windows Azure Marketplace
	 * @author Daniel Boorn info@rapiddigitalllc.com
	 * @copyright 2012 Daniel Boorn
	 * @bingapidoc https://datamarket.azure.com/dataset/bing/search#schema
	 * @license apache 2.0, code is distributed "as is", use at own risk, all rights reserved
	 */
	class BingSearch123{
		
		var $apiKey;
		var $apiRoot = 'https://api.cognitive.microsoft.com/bing/v5.0/search';
		
		/*
		 * construct class
		 * @param string $apiKey (optional)
		 * @throws exception with no api key
		 */
		function __construct()
	    {
	        $this->CI =& get_instance();        
	        
			$this->apiKey = $this->CI->config->item('bing_api_key1');

			if($this->apiKey=="") throw new Exception("API Key Required");
	    }
	
		/*
		 * query bing api
		 * @param string $type (see api specs)
		 * @param mixed (string or array) $query
		 * @return object
		 */
		function search($query){
			if(!is_array($query)) $query = array('q'=>"{$query}");
			try{
				return self::getJSON("{$this->apiRoot}",$query);
			}catch(Exception $e){
				die("<pre>{$e}</pre>");
			}
		}
		
		/*
		 * get json via curl with basic auth
		 * @param string $url
		 * @param array $data
		 * @return object
		 * @throws exception on non-json response (api error)
		 */
		function getJSON($url,$data){
			
			if(!is_array($data)) throw new Exception("Query Data Not Valid. Type Array Required");
			$url .= '?' . http_build_query($data);
			$ch = curl_init($url);			
			print_r(array('Ocp-Apim-Subscription-Key: '.$this->apiKey));
			curl_setopt($ch, CURLOPT_HTTPAUTH, CURLAUTH_BASIC);		    
		    curl_setopt($ch, CURLOPT_HTTPHEADER,array('Ocp-Apim-Subscription-Key: '.$this->apiKey));
		    curl_setopt($ch, CURLOPT_TIMEOUT, 30);
		    curl_setopt($ch, CURLOPT_RETURNTRANSFER, TRUE);
		    
		    $r = curl_exec($ch);
		    echo $r;
		    $json = json_decode($r);
		    print_r($json);
		    if($json==null) throw new Exception("Bad Response: {$r}\n\n{$url}");
		    return $json;
		}
		
		
	}