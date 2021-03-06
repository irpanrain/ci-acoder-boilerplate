<?php

namespace App\Controllers\Backend;

use App\Controllers\BaseController;
use App\Models\UserModel;

class Login extends BaseController
{
	public function index()
	{
		helper(['form']);
		echo view('backend/auth/login');
	}

	public function login()
	{
		$session 	= session();
		$model   	= new UserModel();
		$email   	= $this->request->getVar('email');
		$password   = $this->request->getVar('password');

		$data		= $model->where('email', $email)->first();

		if ($data) {
			$hasPassword 	= $data['password'];
			$verifyPassword = password_verify($password, $hasPassword);

			if ($verifyPassword) {
				$sessionData = [
					'id'		=> $data['id'],
					'name'		=> $data['name'],
					'email'		=> $data['email'],
					'logged_in'	=> TRUE
				];

				$session->set($sessionData);
				return redirect()->to('/');
			} else {
				$session->setFlashdata('error_message', 'Wrong password');
				return redirect()->to('/login');
			}
		} else {
			$session->setFlashdata('error_message', 'Email not registered');
			return redirect()->to('/login');
		}
	}

	public function logout()
	{
		$session = session();
		$session->destroy();

		return redirect()->to('/login');
	}

}
