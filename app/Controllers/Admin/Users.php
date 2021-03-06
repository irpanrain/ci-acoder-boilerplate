<?php

namespace App\Controllers\Admin;

use App\Controllers\BaseController;

class Users extends BaseController
{
	public function index()
	{
		// $this->check();
		$session 	= session();
		
		$data = [
			'title' 	=> 'Users Management',
			'user_name'	=> $session->get('name')
		];

		echo view('backend/users/index', $data);
	}
}
