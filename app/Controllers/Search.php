<?php

namespace App\Controllers;

use CodeIgniter\RESTful\ResourceController;
use App\Models\SearchModel;
use CodeIgniter\HTTP\ResponseInterface;
use CodeIgniter\API\ResponseTrait;
use Exception;

class Search extends ResourceController
{
    protected $modelName = 'App\Models\SearchModel';
	protected $format = 'json';
	use ResponseTrait;

    public function index()
    {
        $data = $this->model->getAllData();
        $response = [
            'status' => 200,
            'error' => "false",
            'message' => '',
            'totaldata' => count($data),
            'data' => $data,
        ];

        return $this->respond($response, 200);
    }

    public function show($cari = null)
    {
        $data = $this->model->showSearch($cari);

        if (count($data) > 1){
            $response = [
                'status' => 200,
                'error' => "false",
                'message' => '',
                'totaldata' => count($data),
                'data' => $data,
            ];
            return $this->respond($response, 200);
        }else if (count($data) === 1){
            $response = [
                'status' => 200,
                'error' => "false",
                'message' => '',
                'totaldata' => count($data),
                'data' => $data,
            ];
            return $this->respond($response, 200);
        } else {
            return $this->failNotFound('Maaf data ' . $cari . ' tidak ditemukan');
        }
    }
}
