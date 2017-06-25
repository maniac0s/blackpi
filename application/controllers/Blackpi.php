<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Blackpi extends CI_Controller 
{
	private $account;
	
	 public function __construct()
        {
                parent::__construct();
		$this->account = $this->config->item('account');
	}

	public function index()
	{
		$get_wallet_info = $this->black_model->get_wallet_info();
		$addresses = $this->black_model->get_addr($this->account);
		if(empty($addresses))
		{
			$addresses[] = $this->black_model->get_new_address($this->account);
		}
		$transactions = $this->black_model->get_txn('listtransactions');
		$data = array
		(
			'get_wallet_info' => $get_wallet_info,
			'addresses' => $addresses,
			'transactions' => $transactions
		);
		$this->load->view('dashboard', $data);
	}

	//TODO own controllers
	public function transactions()
	{
        	$transactions = $this->black_model->json_rpc('listtransactions');
		$data = array
		(
			'transactions' => $transactions
		);
		$this->load->view('transactions', $data);
	}

	public function send_to()
	{	
		$to = $this->input->post('to');
		$amount = $this->input->post('amount');
		$stxfee = ($this->input->post('txfee') === 'setfee')?true:false;
		$this->black_model->send_to($to, $amount, $stxfee);
	}
}
