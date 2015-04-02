<?php
/*
 * github manoj (manrox.drag@gmail.com)
 * Objective : To authendicate with GITHUB and get user details
 */

error_reporting(E_ALL ^ E_NOTICE);
ini_set('display_errors', 1);

class linkedinApi {
	
	
	private $client_id = '';
	private $client_secret = '';
	private $redirect_url = '';
	private $app_name = '';
	
	public $auth_base = 'https://www.linkedin.com/uas/oauth2/';
	public $api_base = 'https://api.linkedin.com/v1';
	public $ln_code = '';
	/*
	 * Variable declaration for future use
	 */
	public $result = array();
	private $user = array();
	
	public function __construct($config) {
		if(is_array($config)){
			$this->client_id = $config['client_id'];
			$this->client_secret = $config['client_secret'];
			$this->redirect_url = $config['redirect_url'];
			//$this->app_name = str_replace(' ','-',$config['app_name']);
			
			$this->ln_code = $_GET['code'];

			
			$this->sendAccessTokenReq();
			
		} else
			die('Invalid configuration..!');
	}

	private function sendAccessTokenReq(){
		$config = array('method' => 'POST',
						'data'=>$this->buildparams(),
						'header'=>array("Content-Type: application/x-www-form-urlencoded"),
						'url' => $this->auth_base.'/accessToken?');
						$this->result = $this->sendRequest($config);
	}
	private function buildParams(){
		return http_build_query(array(
				'grant_type'=> "authorization_code",
				'code' => $this->ln_code,
				'redirect_uri' => $this->redirect_url ,
		        'client_id' => $this->client_id ,
				'client_secret' => $this->client_secret
		        ));
	}
	private function sendRequest($config, $debug=false){
		$ch = curl_init();
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
		if($config['header'] and is_array($config['header'])) {
			curl_setopt($ch, CURLOPT_HEADER, true);
			curl_setopt($ch, CURLOPT_HTTPHEADER, $config['header']);
		}
		curl_setopt($ch, CURLOPT_FOLLOWLOCATION, true);
		if($config['method'] == 'POST' and !empty($config['data'])){
			curl_setopt($ch, CURLOPT_POST, true);
			curl_setopt($ch, CURLOPT_POSTFIELDS, $config['data']);
		} else {
			curl_setopt($ch, CURLOPT_HTTPGET, true);
		}
		curl_setopt($ch, CURLOPT_URL, $config['url']);
		curl_setopt($ch, CURLOPT_FOLLOWLOCATION, true);
		curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 0);
		curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 0);
		$response = curl_exec($ch);
			
		//if($debug) var_dump($response);
		return $response;
		//$this->_access_token = $response['access_token'];
        //$this->_access_token_expires = $response['expires_in'];
	}
// 	private function sendRequest($config){
// 		$curl = curl_init();
// 		curl_setopt_array($curl, array(
//     CURLOPT_RETURNTRANSFER => 1,
//     curl_setopt($curl, CURLOPT_HEADER, true),
//     curl_setopt($curl, CURLOPT_HTTPHEADER, $config['header']),
// 	curl_setopt($curl, CURLOPT_POST, true),
// 	curl_setopt($curl, CURLOPT_POSTFIELDS, $config['data']),
// 	// 		curl_setopt($ch, CURLOPT_HTTPHEADER, $config['header']);
//     CURLOPT_URL => $config['url']
// ));
// 		 $result = curl_exec($curl);
// 		 return $result->linkedinApi->access_token;
// 		curl_close();
// 	
//}	// public function getAccessToken(){
	// 	return $this->result[1]->access_token;
	// }
}