<?php

namespace App\Controllers;

use App\Controllers\BaseController;

class Dashboard extends BaseController
{
	public function index()
	{
		$session 	= session();

		$data = [
			'title' 	=> 'Home Dashboard',
			'user_name'	=> $session->get('name')
		];

		echo view('backend/index', $data);
	}
}
