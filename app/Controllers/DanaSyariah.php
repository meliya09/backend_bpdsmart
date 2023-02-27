<?php namespace App\Controllers;

use App\Models\DanaSyariahModel;
use CodeIgniter\RESTful\ResourceController;
use CodeIgniter\API\ResponseTrait;
use CodeIgniter\HTTP\ResponseInterface;
use CodeIgniter\HTTP\Response;
use Exception;
 
class DanaSyariah extends BaseController
{
    use ResponseTrait;
    // get all product
    public function index()
    {
        $model = new DanaSyariahModel();
        $data = $model->getAllDanaSyariah();
        return $this->respond($data);
    }
 
    // get single product
    public function show($id)
    {
        try {
            $model = new DanaSyariahModel();
            $data = $model->findDanaSyariahById($id);

            return $this->getResponse(
                [
                    'message' => 'Dana Syariah retrieved successfully',
                    'danasyariah' => $data
                ]
            );
        } catch (Exception $e) {
            return $this->getResponse(
                [
                    'message' => 'Could not find client for specified ID'
                ],
                ResponseInterface::HTTP_NOT_FOUND
            );
        }
    }
 
    // create a product
    public function create()
    {
        $model = new DanaSyariahModel();
        $data = [
            'konten_parent' => 45,
            'konten_menu' => $this->request->getVar('konten_menu'),
            'kategori_id' => $this->request->getVar('kategori_id'),
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
 
    // update product 

    public function update($id){

		helper(['form', 'array']);

		$rules = [
			// 'konten_parent' => 'required',
			'konten_menu' => 'required',
			'kategori_id' => 'required',
			
		];


		if(!$this->validate($rules)){
			return $this->fail($this->validator->getErrors());
		}else{
			//$input = $this->request->getRawInput(); gsa
			$data = [
				'konten_id' => $id,
				'konten_parent' => 45,
				'konten_menu' => $this->request->getVar('konten_menu'),
				'kategori_id' => $this->request->getVar('kategori_id'),
				
			];
            $model = new DanaSyariahModel();
            $model->save($data);
            return $this->respond($data);
		}
		

	}
 
    // delete product
    public function delete($id = null)
    {
        $model = new DanaSyariahModel();
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
 
}

 