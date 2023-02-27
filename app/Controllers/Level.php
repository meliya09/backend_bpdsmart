<?php

namespace App\Controllers;

use App\Models\LevelModel;
// use App\Controllers\BaseController;
use CodeIgniter\RESTful\ResourceController;
use CodeIgniter\HTTP\Response;
use CodeIgniter\HTTP\ResponseInterface;
use CodeIgniter\API\ResponseTrait;
use Exception;

class Level extends ResourceController
{
    protected $modelName = 'App\Models\LevelModel';
	protected $format = 'json';
	use ResponseTrait;
 
	public function index(){
		$posts = $this->model->getAllLevel();
		return $this->respond($posts);
	}

	public function show($id = null){
		$data = $this->model->findLevelById($id);
		return $this->respond($data);
	}
 
    // create a product
    public function create()
    {
        $model = new LevelModel();
        $data = [
            'level_nama' => $this->request->getVar('level_nama'),
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
			// 'lokasi_gambar' => 'uploaded[lokasi_gambar]|max_size[lokasi_gambar, 1024]|is_image[lokasi_gambar]',
			'level_nama' => 'required',
			
		];

		if(!$this->validate($rules)){
			return $this->fail($this->validator->getErrors());
		}else{
			
			//$input = $this->request->getRawInput(); gsa
			$data = [
				'level_id' => $id,
				'level_nama' => $this->request->getVar('level_nama'),
			];
			 
			$this->model->save($data);
			return $this->respond($data); 
		}
		
	}

	public function updateLevelAkses($id = null){

		helper(['form', 'array']);

		$rules = [
			'level_akses' => 'required',
			
		];

		if(!$this->validate($rules)){
			return $this->fail($this->validator->getErrors());
		}else{
			
			//$input = $this->request->getRawInput(); gsa
			$data = [
				'level_id' => $id,
				'level_akses' => $this->request->getVar('level_akses'),
			];
			 
			$this->model->save($data);
			return $this->respond($data); 
		}
		
	}

    
 
    // delete product
    public function delete($id = null)
    {
        $model = new LevelModel();
        $data = $model->find($id);
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

    public function updateLevel($id = null){

		helper(['form', 'array']);

		$rules = [
			// 'lokasi_gambar' => 'uploaded[lokasi_gambar]|max_size[lokasi_gambar, 1024]|is_image[lokasi_gambar]',
			'level_akses' => 'required',
			
		];

		if(!$this->validate($rules)){
			return $this->fail($this->validator->getErrors());
		}else{
			
			//$input = $this->request->getRawInput(); gsa
			$data = [
				'level_id' => $id,
				'level_akses' => $this->request->getVar('level_akses'),
			];
			 
			$this->model->save($data);
			return $this->respond($data); 
		}
		
	}
}