<?php

namespace App\Controllers;

use App\Models\LevelLinkModel;
// use App\Controllers\BaseController;
use CodeIgniter\RESTful\ResourceController;
use CodeIgniter\HTTP\Response;
use CodeIgniter\HTTP\ResponseInterface;
use CodeIgniter\API\ResponseTrait;
use Exception;

class LevelLink extends ResourceController
{
    protected $modelName = 'App\Models\LevelLinkModel';
	protected $format = 'json';
	use ResponseTrait;
 
	public function index(){
		$posts = $this->model->getAllLevelLink();
		return $this->respond($posts);
	}

	public function show($id = null){
		$data = $this->model->findLevelLinkById($id);
		return $this->respond($data);
	}

    public function showByLevelId($level_id = null){
		$data = $this->model->getByLevelId($level_id);
		return $this->respond($data);
	}
 
    // create a product
    public function create($level_id = null)
    {
        $model = new LevelLinkModel();
        $data = [
            'level_id' => $this->request->getVar('level_id'),
			'konten_id' => $this->request->getVar('konten_id'),
        ];
        $model->insert($data);
        $response = [
            'status'   => 201,
            'error'    => null,
            'messages' => [
                'success' => 'Data Saved'
            ]
        ]; 
        return $this->respondCreated($response);
    }
  
  
    public function update($id = null){

		helper(['form', 'array']);

		$rules = [
			'level_id' => 'required',   
			'konten_id' => 'required',
			
		];

		if(!$this->validate($rules)){
			return $this->fail($this->validator->getErrors());
		}else{
			$data = [
				'level_link_id' => $id,
                'level_id' => $this->request->getVar('level_id'),
				'konten_id' => $this->request->getVar('konten_id'),
			];
            // var_dump($data);
            // die();
			$this->model->save($data);
			return $this->respond($data); 
		}
		
	}
 
    // delete product
    public function delete($id = null)
    {
        $model = new LevelLinkModel();
        $data = $model->findLevelLinkById($id);
        if($data){
            $model->delete($id);
            $response = [
                'status'   => 200,
                'error'    => null,
                'messages' => [
                    'success' => 'Data Deleted'
                ]
            ];
            return $this->respondDeleted($response);
        }else{
            return $this->failNotFound('No Data Found with id '.$id);
        }
         
    }
}