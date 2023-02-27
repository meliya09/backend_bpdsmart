<?php namespace App\Controllers;

use App\Models\KirimanUangKonvenModel;
use CodeIgniter\RESTful\ResourceController;
use CodeIgniter\API\ResponseTrait;
use CodeIgniter\HTTP\ResponseInterface;
use CodeIgniter\HTTP\Response;
use Exception;
 
class KirimanUangKonven extends BaseController
{
    use ResponseTrait;
    // get all product
    public function index()
    {
        $model = new KirimanUangKonvenModel();
        $data = $model->getAllKirimanUangKonven();
        return $this->respond($data);
    }
 
    // get single product
    public function show($id)
    {
        try {
            $model = new KirimanUangKonvenModel();
            $data = $model->findKirimanUangKonvenById($id);

            return $this->getResponse(
                [
                    'message' => 'Kiriman Uang Konven retrieved successfully',
                    'kirimankonven' => $data
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
        $model = new KirimanUangKonvenModel();
        $data = [
           
            'konten_parent' => 39,
            'konten_menu' => $this->request->getVar('konten_menu'),
            'kategori_id' => $this->request->getVar('kategori_id'),
            'konten_approval' => '0', 
           
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
    public function update($id = null){

		helper(['form', 'array']);

		$rules = [
            'konten_parent' => 39,
			'konten_menu' => 'required',
			'kategori_id' => 'required',
           
		];
			$data = [
				'konten_id' => $id,
				'konten_parent' => 39,
				'konten_menu' => $this->request->getVar('konten_menu'),
				'kategori_id' => $this->request->getVar('kategori_id'),

			];
            $model = new KirimanUangKonvenModel();
            $model->save($data);
			return $this->respond($data);

        //  $model = new StafModel();
        // $input = $this->request->getRawInput();
        // $data = [
           
        //     'user_nama' => $input['user_nama'],
        //     'user_jabatan' => $input['user_jabatan'],
        //     'user_email' => $input['user_email'],
        //     'user_telp' => $input['user_telp'],
        //     'level_id' => $input['level_id'],
        //     'user_admin' => $input['user_admin'],
            

        // ];
        // $model->update($id, $data);

        // $response = [
        //     'status'   => 200,
        //     'error'    => null,
        //     'messages' => [
        //         'success' => 'Data Updated'
        //     ]
        // ];
        // return $this->respond($response);
		

	}
 
    // delete product
    public function delete($id = null)
    {
        $model = new KirimanUangKonvenModel();
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