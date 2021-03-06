<?php

namespace App\Controllers\Backend;

use App\Controllers\BaseController;

class ForgotPassword extends BaseController
{
	public function index()
	{
		echo view('backend/auth/forgot_password');
	}
}
