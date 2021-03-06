<?php

namespace App\Controllers\Api;

use App\Controllers\BaseController;
use App\Models\ClientModel;
use CodeIgniter\HTTP\Response;
use CodeIgniter\HTTP\ResponseInterface;
use Exception;

class Client extends BaseController
{
	/**
	* Get all clients
	* @return Response
	*/
	public function index()
	{
		$model = new ClientModel();
		return $this->getResponse(
			[
				'message'	=> 'Client retrieved successfully',
				'clients'	=> $model->findAll()
			]
		);
	}


	/**
	* Create new client
	* @return Response
	*/
	public function store()
	{
		$rules = [
			'name'			=> 'required',
			'email'			=> 'required|min_length[6]|max_length[50]|valid_email|is_unique[client.email]',
			'retainer_fee'	=> 'required|max_length[255]'
		];

		$input = $this->getRequestInput($this->request);

		if (!$this->validateRequest($input, $rules)) {
			return $this
				->getResponse(
					$this->validator->getErrors(),
					ResponseInterface::HTTP_BAD_REQUEST
				);
		}

		$clientEmail = $input['email'];

		$model = new ClientModel();
		$model->save($input);

		$client = $model->where('email', $clientEmail)->first();

		return $this->getResponse(
			[
				'message'	=> 'Client added successfully',
				'client'	=> $client
			]
		);
	}

	/**
	* Get client by id
	* @param int $id 
	* @return Response
	*/
	public function show($id)
	{
		try {
			$model  = new ClientModel();
			$client = $model->findClientById($id);

			return $this->getResponse(
				[
					'message' 	=> 'Client retrieved successfully',
					'client'	=> $client
				]
			);

		} catch (Exception $e) {
			return $this->getResponse(
				[
					'message' => 'Could not find client for specified id'
				],
				ResponseInterface::HTTP_NOT_FOUND
			);
		}
	}

	/**
	* Update client by id
	* @param int $id 
	* @return Response
	*/
	public function update($id)
	{
		try {
			
			$model = new ClientModel();
			$model->findClientById($id);

			$input = $this->getRequestInput($this->request);

			$model->update($id, $input);
			$client = $model->findClientById($id);

			return $this->getResponse(
				[
					'message'	=> 'Client updated successfully',
					'client'	=> $client
				]
			);

		} catch (Exception $e) {
			return $this->getResponse(
				[
					'message' => $e->getMessage()
				],
				ResponseInterface::HTTP_NOT_FOUND
			);
		}
	}

	/**
	* Delete client by id
	* @param int $id 
	* @return Response
	*/
	public function destroy($id)
	{
		try {
			
			$model  = new ClientModel();
			$client = $model->findClientById($id);
			$model->delete($client);

			return $this->getResponse(
				[
					'message' => 'Client deleted successfully',
				]
			); 
		} catch (Exception $e) {
			return $this->getResponse(
				[
					'message' => $e->getMessage()
				],
				ResponseInterface::HTTP_NOT_FOUND
			);
		}
	}	

}
