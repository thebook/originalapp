<?php

/**
* A class for searching and generating aamazon results
*/
class amazon extends alpha_tree_api
{

	function __construct($params)
	{
		parent::__construct($params);
		$this->paramaters['service_name']   = 'AWSECommerceService';
		$this->paramaters['access_key']     = $params['amazon_access_key'];
		$this->paramaters['secret_key']     = $params['amazon_secret_key'];
		$this->paramaters['associates_id']  = $params['amazon_associates_id'];
		$this->paramaters['amazon_host']    = 'ecs.amazonaws.'. $this->_set_country_domain($params['region']);
		$this->create();
	}

	public function create ()
	{
		// $paramaters = $_POST['paramaters'];	
		$paramaters = $this->_item_search();
		$this->_make_the_call($paramaters);

		// exit;
	}

	protected function _make_the_call ($paramaters)
	{
		$paramaters = $this->_insert_credentials($paramaters);

		ksort($paramaters);

		$paramaters     = $this->_convert_array_into_url_paramaters($paramaters);
		$hash_signature = $this->_create_signature($paramaters);
		$request_url    = "http://{$this->paramaters['amazon_host']}/onca/xml?$paramaters&Signature=$hash_signature";
			
		$this->_curl_call($request_url);

	}

	protected function _item_search ()
	{
		return array(
			'Operation' => 'ItemSearch',
			'SearchIndex' => 'All',
			'Keywords' => 'Wuthering'
		);
	}

	protected function _curl_call ($request)
	{
		$ch = curl_init();
	    curl_setopt($ch, CURLOPT_URL, $request);
	    curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
	    curl_setopt($ch, CURLOPT_TIMEOUT, 15);
	    curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 0);

	    $response = curl_exec($ch);

	    
	  	// $response = rawurldecode($response);
	    // echo $response;
	    $amazon_xml = simplexml_load_string($response);
	    var_export($amazon_xml->OperationRequest->Arguments);

	//     if ( $response !== false ) { 

	//     	$parse_xml = simplexml_load_string($response);

 //        	echo (($parse_xml === false) ? "false" : $parse_xml);
	//     }
	//     else { 
	//     	echo "false";
	//     }
	}


	protected function _insert_credentials ($array_to_insert_credentials_in)
	{
		$array_to_insert_credentials_in['Service']           = $this->paramaters['service_name'];
		$array_to_insert_credentials_in['AWSAccessKeyId']    = $this->paramaters['access_key'];
		$array_to_insert_credentials_in['AssociateTag']      = $this->paramaters['associates_id'];
		$array_to_insert_credentials_in['Timestamp']         = $this->_create_timestamp();
		
		return $array_to_insert_credentials_in;
	}

	protected function _set_country_domain ($country_domain)
	{
		$possible_domains = array('de', 'com', 'co.uk', 'ca', 'fr', 'co.jp', 'it', 'cn', 'es');
		
		return (in_array($country_domain, $possible_domains)? $country_domain : 'com' );
	}

	protected function _create_signature ($paramaters_string, $uri = '/onca/xml', $method = 'GET')
	{
		$the_string_to_hash_tag = "$method\n{$this->paramaters['amazon_host']}\n$uri\n$paramaters_string";
		$the_string_to_hash_tag = base64_encode(hash_hmac('sha256', $the_string_to_hash_tag, $this->paramaters['secret_key'], true ));
		
		return str_replace('%7E', '~', rawurlencode( $the_string_to_hash_tag ));
	}

	protected function _create_timestamp ()
	{
		return gmdate('Y-m-d\TH:i:s\Z');
	}

	protected function _convert_array_into_url_paramaters ($array_to_convert)
	{
		$sorting_array = array();

		foreach ($array_to_convert as $option_name => $option_value) :
			
			$option_name     = str_replace('%7E', '~', rawurlencode($option_name));
			$option_value    = str_replace('%7E', '~', rawurlencode($option_value));
			$sorting_array[] = "$option_name=$option_value";

		endforeach;

		return implode('&', $sorting_array );
	}
}

?>