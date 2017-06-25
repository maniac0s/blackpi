<?php
(defined('BASEPATH')) OR exit('No direct script access allowed');

class Black_model extends CI_Model 
{

	private $rpc_auth;
	private $url;
	private $available = false;

	public function __construct() 
	{
		parent::__construct();
		$this->rpc_auth = $this->config->item('rpc_auth');
		$this->url = 'http://'.$this->rpc_auth[0].':'.$this->rpc_auth[1].'@localhost:15715';
	}
	
	public function get_info()
	{
                $getinfo = $this->json_rpc('getinfo');
		return $getinfo;
	}

	public function get_wallet_info()
	{
		$wallet_info = $this->json_rpc('getwalletinfo');
		return $wallet_info;
	}
	
	public function get_addr($account = 'raspi')
	{
                $address = $this->json_rpc('getaddressesbyaccount', array($account));
		return $address;
	}
	
        public function get_txn($limit = false)
        {
		//TODO $limit = array($low, $high);

        	$transactions = $this->json_rpc('listtransactions');
		return $transactions;
        }

	public function get_new_address($account = 'raspi')
	{
		$new_address = $this->json_rpc('getnewaddress', array($account));
		return $new_address;
	}

	public function send_to($to = false, $amount = 0.0, $stxfee = false)
	{
		if($to !== true)
		{
			$params = array($to, $amount, '', '');
			if($stxfee !== false)
			{
				 array_push($params, true);
			}
			$this->json_rpc('sendtoaddress', $params);
		}
		echo "Sending $amount to $to with txfee included: "; echo ($stxfee === true)?'yes':'no';
	}

        private function json_rpc($method = 'getinfo', $params = false)
        {
                $data['method'] = $method;
                if($params !== false)
                {
                        $data['params'] = $params;
                }

                $data_string = json_encode($data);
                $ch = curl_init($this->url);
                curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "POST");
                curl_setopt($ch, CURLOPT_POSTFIELDS, $data_string);
                curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
                curl_setopt($ch, CURLOPT_HTTPHEADER, array
                (
                        'Content-Type: text/plain',
                        'Content-Length: ' . strlen($data_string))
                );

                $result = curl_exec($ch);
		$result = json_decode($result, true);
                $status = curl_getinfo($ch);
		if(!isset($result))
		{
			echo ' No answer from coin server';
			return false;
		}
                if($status['http_code'] != 200)
                {
			var_dump($result);
			if ($result['error']['code'] === -28)
	                {
        	                echo $result['error']['message'];
				return false;
			}
			else
			{
                        	var_dump(json_decode($result));
				return false;
			}
                }
                return $result['result'];
        }
}
