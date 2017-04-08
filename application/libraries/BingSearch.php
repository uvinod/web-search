<?php
class BingSearch
{
    /**
     * Bing Search API URL Root
     *
     * @var string
     **/
    var $api_root;

    /**
     * Google API Key
     *
     * @var string
     **/
    var $api_key;

    /**
     * Constructor
     *
     * @param string search_engine_id Search Engine ID
     * @param string api_key API Key
     * @return void
     **/
    function __construct()
    {
        $this->CI =& get_instance();
        
        $this->api_key = $this->CI->config->item('bing_api_key1');
        $this->api_root = 'https://api.cognitive.microsoft.com/bing/v5.0/search';
    }

    /**
     * Sends search request to Google
     *
     * @param array params The parameters of the search request
     * @return object The raw results of the search request
     **/
    function request($params) 
    {

        // disable peer verification
        $context = stream_context_create([
            'http' => [
                'ignore_errors' => true
            ],
            'ssl' => [
                'verify_peer' => false,
                'verify_peer_name' => false,
            ]
        ]);
        
        $response = $this->getSslPage($this->api_root.'?'. http_build_query($params), true);        

        return json_decode($response);
    }

    /**
     * Perform search
     *
     * Returns an object with the following properties:
     *
     *   page
     *   perPage
     *   start
     *   end
     *   totalResults
     *   results
     *     title
     *     snippet
     *     htmlSnippet
     *     link
     *     image
     *     thumbnail
     *
     * @param string terms The search terms
     * @param integer page The page to return
     * @param integer per_page How many results to dispaly per page
     * @param array extra Extra parameters to pass to Google
     * @return object The results of the search
     * @throws Exception If error is returned from Google
     **/
    function search($terms, $page=1, $per_page=10, $extra=[])
    {
        // Google only allows 10 results at a time
        $per_page = ($per_page > 10) ? 10 : $per_page;
        
        $params = [
            'q' => $terms,
            'offset' => ($page - 1) * $per_page,
            'count' => $per_page
        ];

        if (sizeof($extra)) {
            $params = array_merge($params, $extra);
        }

        $response = $this->request($params);

        if (isset($response->error)) {
            throw new \Exception($response->error->message);
        }

        $results = new \stdClass();
        
        if(!property_exists($response, 'webPages')) {
            $results->totalResults = 0;
            $results->results = [];
        } else {
            $response = $response->webPages;
            
            $results->page = $page;
            $results->perPage = $per_page;
            $results->totalResults = $response->totalEstimatedMatches;
            $results->results = [];
            
            if (isset($response->value)) {

                foreach ($response->value as $result) {
                    $results->results[] = (object) [
                        'title' => $result->name,
                        'snippet' => $result->snippet,
                        'link' => $this->addScheme($result->displayUrl)
                    ];
                }   
            }
        }
        return $results;
    }

    /**
     * Allow call to api under https using cURL - replacement function for file_get_contents
     * By setting CURLOPT_RETURNTRANSFER to true we're able to fetch the results via cURL
     * @param string $url
     * @return Object $results
     */
    function getSslPage($url, $is_bing) {
        
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, FALSE);
        if($is_bing == true)
            curl_setopt($ch, CURLOPT_HTTPHEADER,array('Ocp-Apim-Subscription-Key: '.$this->api_key));
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, TRUE);
        $result = curl_exec($ch);
        curl_close($ch);
        
        return $result;
    }

    /**
     * Prepend http to URL
     * @param string $url, $scheme
     * @return String $url
     */
    function addScheme($url, $scheme = 'http://')
    {
      return parse_url($url, PHP_URL_SCHEME) === null ?
        $scheme . $url : $url;
    }
}
