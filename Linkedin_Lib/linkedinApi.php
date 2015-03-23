<?php
/*
 * github manoj (manrox.drag@gmail.com)
 * Objective : To authendicate with GITHUB and get user details
 */

error_reporting(E_ALL ^ E_NOTICE);
ini_set('display_errors', 1);

class githubApi {
	
	
	private $client_id = '';
	private $client_secret = '';
	private $redirect_url = '';
	private $app_name = '';
	
	public $auth_base = 'https://github.com/';
	public $api_base = 'https://api.github.com/';
	public $git_code = '';
	/*
	 * Variable declaration for future use
	 */
	private $result = array();
	private $user = array();
	
	public function __construct($config) {
		if(is_array($config)){
			$this->client_id = $config['client_id'];
			$this->client_secret = $config['client_secret'];
			$this->redirect_url = $config['redirect_url'];
			$this->app_name = str_replace(' ','-',$config['app_name']);
			
			$this->git_code = $_GET['code'];
			
			$this->sendAccessTokenReq();
			
		} else
			die('Invalid configuration..!');
	}