<?php

namespace App\Controllers\Backend;

use App\Controllers\BaseController;
use App\Models\UserModel;

class Register extends BaseController
{
	public function index()
	{
		helper(['form']);
		$data = [];
		echo view('backend/auth/register', $data);
	}

	public function register()
	{
		helper(['form']);

		$rules = [
			'name'				=> 'required|min_length[3]|max_length[20]',
			'email' 			=> 'required|min_length[6]|max_length[50]|valid_email|is_unique[user.email]',
			'password'			=> 'required|min_length[6]|max_length[200]',
			'confirm_password'	=> 'matches[password]'
		];

		$input 		= $this->getRequestInput($this->request);
		$session 	= session();

		if (!$this->validateRequest($input, $rules)) {
			$session->setFlashdata('error_message', $this->validator->getErrors());
			return redirect()->to('/register');
		}

		$userModel = new UserModel();
		$userModel->save($input);

		if ($userModel) {
			$data = $userModel->where('email', $input['email'])->first();
			$sessionData = [
				'id'		=> $data['id'],
				'name'		=> $data['name'],
				'email'		=> $data['email'],
				'logged_in'	=> TRUE
			];

			$session->set($sessionData);
			return redirect()->to('/');
		}
	}
}
